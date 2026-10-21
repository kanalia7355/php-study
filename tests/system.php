<?php
declare(strict_types=1);
require __DIR__.'/../scripts/quest.php';
function assertSystem(bool $v,string $message):void{if(!$v)throw new RuntimeException($message);}
$tmp=sys_get_temp_dir().'/quest-selftest-'.bin2hex(random_bytes(8));mkdir($tmp);
try {
    $path=glob(QUEST_ROOT.'/solutions/chapter_01*.ipynb')[0];
    $notebook=json_decode(file_get_contents($path),true,512,JSON_THROW_ON_ERROR);$index=0;
    foreach($notebook['cells'] as $cell) {
        if($cell['cell_type']!=='code')continue;
        $id=sprintf('ch01-ex%02d',++$index);mkdir($tmp.'/'.$id);
        $file=$tmp.'/'.$id.'/main.php';
        $source=str_replace('<language>php</language>','',implode('',$cell['source']));
        file_put_contents($file,$source);
        $r=runTask($id,$tmp);assertSystem($r['status']==='pass',"正答が不合格: $id ".json_encode($r,JSON_UNESCAPED_UNICODE));
        file_put_contents($file,'<?php echo "誤答";');
        assertSystem(runTask($id,$tmp)['status']==='fail',"誤答が合格: $id");
        file_put_contents($file,$source);assertSystem(runTask($id,$tmp)['status']==='pass',"再提出が失敗: $id");
        echo "PASS $id: 正答・誤答・再提出\n";
    }
    $file=$tmp.'/ch01-ex02/main.php';
    file_put_contents($file,'<?php $name="山田太郎";$age=25;$hobby="読書"; echo "私の名前は山田太郎です。\n年齢は25歳です。\n趣味は読書です。";');
    assertSystem(runTask('ch01-ex02',$tmp)['status']==='fail','出力ハードコードを見逃しています');
    file_put_contents($file,'<?php while (true) {}');
    assertSystem(runTask('ch01-ex02',$tmp)['status']==='fail','無限ループを終了できません');
    echo "PASS 固定出力・時間制限\n";
} finally {
    foreach(glob($tmp.'/*') as $dir){foreach(glob($dir.'/*') as $f)unlink($f);rmdir($dir);}rmdir($tmp);
}
