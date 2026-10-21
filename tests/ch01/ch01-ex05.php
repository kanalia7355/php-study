<?php
return static function(array $s):void {
    $check=static function(array $s):void {
        $v=$s['vars'];
        foreach(['name','age','height','hobbies','is_student'] as $key)expect(array_key_exists($key,$v),'$'.$key.'を定義してください');
        expect(is_string($v['name'])&&$v['name']!==''&&is_int($v['age'])&&$v['age']>=0,'名前は文字列、年齢は整数です');
        expect(is_float($v['height'])&&$v['height']>0&&is_bool($v['is_student']),'身長は浮動小数点数、学生フラグは真偽値です');
        expect(is_array($v['hobbies'])&&count($v['hobbies'])===3,'趣味は3要素の配列にしてください');
        foreach($v['hobbies'] as $h)expect(is_string($h)&&$h!=='','趣味は空でない文字列にしてください');
        $expected="=== プロフィール ===\n名前: {$v['name']}\n年齢: {$v['age']}歳\n身長: {$v['height']}cm\n趣味: ".implode(', ',$v['hobbies'])."\n学生: ".($v['is_student']?'はい':'いいえ')."\n===================";
        expect(trim(str_replace("\r\n","\n",$s['output']))===$expected,'指定のプロフィール形式で変数の内容を表示してください');
    };
    $check($s);
    foreach([false,true] as $student)$check(withOverrides($s,['name'=>'検証者','age'=>28,'height'=>165.25,'hobbies'=>['映画','料理','散歩'],'is_student'=>$student]));
};
