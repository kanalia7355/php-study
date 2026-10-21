<?php
return static function(array $s):void {
    $check=static function(array $s):void {
        $v=$s['vars'];
        expect(isset($v['favorite_food'],$v['today'],$v['height'],$v['is_fun']),'指定された4変数を定義してください');
        expect(is_string($v['favorite_food'])&&$v['favorite_food']!=='','好きな食べ物は空でない文字列です');
        expect(is_int($v['today'])&&$v['today']>=1&&$v['today']<=31,'日付は1〜31の整数です');
        expect(is_float($v['height'])&&$v['height']>0,'身長は正の浮動小数点数です');
        expect($v['is_fun']===true,'$is_funは真偽値のtrueです');
        foreach(['favorite_food','today','height','is_fun'] as $name) {
            ob_start();var_dump($v[$name]);$dump=trim(ob_get_clean());
            expect(str_contains($s['output'],$dump),'var_dumpで4変数の実際の型と値を表示してください');
        }
        $calls=array_filter($s['tokens'],static fn($t)=>is_array($t)&&$t[0]===T_STRING&&strtolower($t[1])==='var_dump');
        expect(count($calls)>0,'var_dumpを呼び出してください');
    };
    $check($s);$check(withOverrides($s,['favorite_food'=>'検証用ごはん','today'=>23,'height'=>181.75]));
};
