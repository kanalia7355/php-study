<?php
declare(strict_types=1);
[$script,$id,$file,$test]=$argv;
function expect(bool $condition, string $reason): void {if(!$condition)throw new RuntimeException($reason);}
function loadSubmission(string $path): array {
    ob_start();
    try {
        $vars=(static function(string $__path):array{require $__path;return get_defined_vars();})($path);
        return ['vars'=>$vars,'output'=>ob_get_contents(),'source'=>file_get_contents($path),'tokens'=>token_get_all(file_get_contents($path)), 'file'=>$path];
    } finally {ob_end_clean();}
}
function withOverrides(array $submission, array $overrides): array {
    $tokens=$submission['tokens'];$output='';$pending=null;$assigned=[];
    for($i=0;$i<count($tokens);$i++) {
        $token=$tokens[$i];$text=is_array($token)?$token[1]:$token;$output.=$text;
        if(is_array($token)&&$token[0]===T_VARIABLE&&array_key_exists(substr($text,1),$overrides)&&!isset($assigned[$text])) {
            $j=$i+1;
            while(isset($tokens[$j])&&is_array($tokens[$j])&&in_array($tokens[$j][0],[T_WHITESPACE,T_COMMENT,T_DOC_COMMENT],true))$j++;
            if(($tokens[$j]??null)==='=')$pending=$text;
        }
        if($text===';'&&$pending!==null) {
            $output.="\n".$pending.' = '.var_export($overrides[substr($pending,1)],true).";\n";
            $assigned[$pending]=true;$pending=null;
        }
    }
    foreach($overrides as $name=>$value)expect(isset($assigned['$'.$name]),"入力変数 $".$name." の代入が必要です");
    $tmp=tempnam(sys_get_temp_dir(),'quest-variant-');
    try{file_put_contents($tmp,$output);return loadSubmission($tmp);}finally{unlink($tmp);}
}
try {
    // Unexpected warnings are failures, including undefined variables and deprecated behavior.
    set_error_handler(static function(int $level,string $message,string $path,int $line):never {throw new ErrorException($message,0,$level,$path,$line);});
    $submission=loadSubmission($file);
    $check=require $test;
    $check($submission);
    echo json_encode(['id'=>$id,'status'=>'pass'],JSON_THROW_ON_ERROR);
} catch(Throwable $e) {
    echo json_encode(['id'=>$id,'status'=>'fail','reason'=>$e->getMessage()],JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR);exit(1);
}
