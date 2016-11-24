<?php
return [

    //合作身份者id，以wx开头的18位字符串。
    'app_id' => env('KWA_WX_APP_ID'),

    //商户号 字符串。
    'mch_id' => env('KWA_WX_MCH_ID'),
    //商户密钥32位字符串
    'key' => env('KWA_WX_KEY'),

    'trade_type' => 'APP',
    // 签名方式
    'sign_type' => 'RSA',

    // 异步通知连接。
    'notify_url' => "http://xxx.xxx.com/wxpay/notify"
];
