<?php
return static function(array $s):void {
    $check=static function(array $s):void {
        $v=$s['vars'];
        expect(isset($v['name'],$v['age'],$v['hobby']),'$name・$age・$hobbyを定義してください');
        expect(is_string($v['name'])&&$v['name']!==''&&is_int($v['age'])&&$v['age']>=0&&is_string($v['hobby'])&&$v['hobby']!=='','名前と趣味は空でない文字列、年齢は0以上の整数にしてください');
        $expected="私の名前は{$v['name']}です。\n年齢は{$v['age']}歳です。\n趣味は{$v['hobby']}です。";
        expect(trim(str_replace("\r\n","\n",$s['output']))===$expected,'3行の自己紹介を、変数の内容と一致させてください');
    };
    $check($s);$check(withOverrides($s,['name'=>'検証用の名前','age'=>31,'hobby'=>'散歩']));
};
