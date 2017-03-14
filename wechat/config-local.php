<?php

return array(

    //公众平台
    'appId' => 'wx785f0312a91e77da',
    'appSecret' => 'f14e99f456b7623dfefba3d249b5f2d2 ',
    'token' => 'weixin2016',
    'encodingAesKey' => 'a7f3JvDXpsVfrkpmhg45wASZZU8yjcyK7fIVZDpxPtX',
    'middleUrl' => null,

    //微信支付
    'mchId' => 'xxxxxxx',
    'apiSecret' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'sslCert' => '/Users/ethan/Desktop/esitools/cert/apiclient_cert.pem',
    'sslKey' => '/Users/ethan/Desktop/esitools/cert/apiclient_key.pem',
    'caInfo' => '/Users/ethan/Desktop/esitools/cert/rootca.pem',

    //日志
    'log' => array(
        'class' => 'PFinal\Wechat\Support\Logger',
        'name' => 'pfinal.wechat',
        'level' => Monolog\Logger::DEBUG,
        'file' => './wechat.log',
    ),

    //会话
    'session' => array(
        'class' => 'PFinal\Session\NativeSession',
        'keyPrefix' => 'pfinal.wechat'
    ),

    //缓存
    'cache' => array(
        'class' => 'PFinal\Cache\FileCache',
        'keyPrefix' => 'pfinal.wechat'
    ),
);