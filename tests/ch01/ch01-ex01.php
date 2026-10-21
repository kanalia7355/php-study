<?php
return static function(array $s):void {
    expect(trim($s['output'])==='こんにちは、PHP世界！','echoで「こんにちは、PHP世界！」を表示してください');
    $types=array_column(array_filter($s['tokens'],'is_array'),0);
    expect(in_array(T_OPEN_TAG,$types,true)&&in_array(T_CLOSE_TAG,$types,true),'開始・終了PHPタグが必要です');
    expect(in_array(T_ECHO,$types,true),'echoを使ってください');
    expect(in_array(';',$s['tokens'],true),'文末のセミコロンが必要です');
};
