<?php
declare(strict_types=1);
const QUEST_ROOT = __DIR__ . '/..';
function tasks(): array {
    $chapters = json_decode(file_get_contents(QUEST_ROOT . '/curriculum/inventory.json'), true, 512, JSON_THROW_ON_ERROR);
    $result = [];
    foreach ($chapters as $chapter) foreach ($chapter['tasks'] as $task) $result[$task['id']] = $task + ['chapter' => $chapter['chapter']];
    return $result;
}
function runTask(string $id, string $workspace): array {
    $test = QUEST_ROOT . '/tests/ch' . substr($id, 2, 2) . '/' . $id . '.php';
    $file = $workspace . '/' . $id . '/main.php';
    if (!is_file($test)) return ['id' => $id, 'status' => 'unavailable', 'reason' => 'この課題の採点テストは未実装です'];
    if (!is_file($file)) return ['id' => $id, 'status' => 'skip', 'reason' => '未提出'];
    $source = file_get_contents($file);
    if (str_contains($source, '// QUEST: NOT STARTED')) return ['id' => $id, 'status' => 'skip', 'reason' => '未着手（マーカーを削除して提出）'];
    $pipes = [];
    $process = proc_open([PHP_BINARY, '-n', '-d', 'extension_dir=' . ini_get('extension_dir'), '-d', 'extension=tokenizer', '-d', 'memory_limit=64M', '-d', 'max_execution_time=5', __DIR__ . '/task-runner.php', $id, realpath($file), realpath($test)], [['pipe','r'],['pipe','w'],['pipe','w']], $pipes, sys_get_temp_dir(), ['PATH' => getenv('PATH') ?: '/usr/bin:/bin']);
    if (!is_resource($process)) throw new RuntimeException('PHPプロセスを起動できません');
    fclose($pipes[0]);
    stream_set_blocking($pipes[1], false);stream_set_blocking($pipes[2], false);
    $out='';$err='';$started=microtime(true);$code=-1;
    while (true) {
        $out .= stream_get_contents($pipes[1]);$err .= stream_get_contents($pipes[2]);
        if (strlen($out)+strlen($err)>131072 || microtime(true)-$started>7) {
            proc_terminate($process, 9);$err .= '実行時間または出力サイズの上限を超えました';break;
        }
        $status=proc_get_status($process);
        if (!$status['running']) {$code=$status['exitcode'];break;}
        usleep(10000);
    }
    $out.=stream_get_contents($pipes[1]);$err.=stream_get_contents($pipes[2]);
    fclose($pipes[1]);fclose($pipes[2]);proc_close($process);
    $data=json_decode($out,true);
    if ($code===0 && is_array($data) && ($data['id']??null)===$id && ($data['status']??null)==='pass') {
        return ['id'=>$id,'status'=>'pass','reason'=>'すべての合格条件を満たしました','sha256'=>hash_file('sha256',$file)];
    }
    return ['id'=>$id,'status'=>'fail','reason'=>is_array($data) ? ($data['reason']??'採点に失敗しました') : trim($err . "\n" . $out)];
}
if (realpath($_SERVER['SCRIPT_FILENAME'])===__FILE__) {
    try {
        $command=$argv[1]??'help';$all=tasks();
        if ($command==='list') {foreach($all as $id=>$t) echo "$id {$t['title']}\n";exit(0);}
        if ($command!=='check') {echo "使い方: php scripts/quest.php list | check [課題ID|all]\n";exit($command==='help'?0:2);}
        $selector=$argv[2]??'all';
        if ($selector!=='all' && !isset($all[$selector])) throw new InvalidArgumentException('存在しない課題IDです');
        $workspace=getenv('QUEST_WORKSPACE') ?: QUEST_ROOT . '/workspace';
        $ids=$selector==='all'?array_keys($all):[$selector];$results=[];$failed=false;
        foreach($ids as $id) {
            $r=runTask($id,$workspace);$results[]=$r;
            echo strtoupper($r['status'])." $id: {$r['reason']}\n";
            if (in_array($r['status'],['fail','unavailable'],true))$failed=true;
        }
        $report=getenv('QUEST_REPORT');
        if ($report) file_put_contents($report,json_encode(['schema'=>1,'commit'=>getenv('GITHUB_SHA')?:null,'results'=>$results],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR)."\n");
        exit($failed?1:0);
    } catch(Throwable $e) {fwrite(STDERR,$e->getMessage()."\n");exit(2);}
}
