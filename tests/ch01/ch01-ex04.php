<?php
return static function(array $s):void {
    $single=false;$multi=false;
    foreach($s['tokens'] as $t) {
        if(!is_array($t)||!in_array($t[0],[T_COMMENT,T_DOC_COMMENT],true))continue;
        if(preg_match('/ここ|書いて|記述しましょう|QUEST:/u',$t[1]))continue;
        if(str_starts_with($t[1],'//')&&strlen(trim(substr($t[1],2)))>0)$single=true;
        if(str_starts_with($t[1],'/*')&&strlen(trim(substr($t[1],2,-2)))>0)$multi=true;
    }
    expect($single&&$multi,'説明を含む一行コメントと複数行コメントを、それぞれ追加してください');
    expect(trim($s['output'])==='ようこそ！','コメントで歓迎メッセージの実行結果を変えないでください');
    expect(isset($s['vars']['user_name'],$s['vars']['login_count']),'元の2変数を維持してください');
};
