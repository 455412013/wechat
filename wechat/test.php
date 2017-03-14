<?php

require __DIR__ . '/vendor/autoload.php';

use PFinal\Wechat\Kernel;
use PFinal\Wechat\Message\Receive;
use PFinal\Wechat\Message;
use PFinal\Wechat\WechatEvent;
use PFinal\Wechat\Support\Log;
use PFinal\Wechat\Service\MessageService;

//配置项
$config = require __DIR__ . '/config-local.php';


/**
 * 向用户推送信息
 */
//初始化
$openid2='owBvtwT-0xURbeeOq93xd2N0eBiY';
Kernel::init($config);
//$result = MessageService::send($openid2, new \PFinal\Wechat\Message\Text('您好啊1118'));
//var_dump($result);exit;
/**
 * 发送图片
 */
//$res=\PFinal\Wechat\Service\MaterialService::uploadFileTemporary('demo.jpg','image');
//$media_id=$res['media_id'];
//$resArr=MessageService::send($openid2,new Message\Image($media_id));
//var_dump($resArr);
/**
 * 生成菜单
 */
//$json='{
//     "button":
//     [
//     {
//          "type":"click",
//          "name":"今日歌曲",
//          "key":"V1001_TODAY_MUSIC"
//      },
//      {
//           "name":"菜单",
//           "sub_button":[
//           {
//               "type":"view",
//               "name":"搜索",
//               "url":"http://www.soso.com/"
//            },
//            {
//               "type":"view",
//               "name":"视频",
//               "url":"http://v.qq.com/"
//            },
//            {
//               "type":"click",
//               "name":"赞一下我们",
//               "key":"V1001_GOOD"
//            }]
//       }
//       ]
// }';




//$arr=[
//        ['type'=>'click','name'=>'今日歌曲','key'=>'music'],
//        ['type'=>'click','name'=>'今日新闻','key'=>'news'],
////        ['name'=>'菜单','sub_button'=>[
////            ['type'=>'view','name'=>'搜索','url'=>'http://www.soso.com/'],
////            ['type'=>'view','name'=>'视频','url'=>'http://v.qq.com/'],
////            ['type'=>'click','name'=>'赞一下我们','key'=>'V1001_GOOD'],
////        ]
////        ]
//];


//
//$arr=[
//    ['type'=>'click','name'=>'今日歌曲','key'=>'music']
////    ['type'=>'click','name'=>'今日新闻','key'=>'news'],
//];
$res=\PFinal\Wechat\Service\MenuService::create([
    ['type'=>'click','name'=>'笑话推荐','key'=>'jokes'],
    ['type'=>'click','name'=>'今日新闻','key'=>'news'],
    ['name'=>'菜单','sub_button'=>[
            ['type'=>'view','name'=>'搜索','url'=>'http://www.soso.com/'],
            ['type'=>'view','name'=>'视频','url'=>'http://v.qq.com/'],
            ['type'=>'click','name'=>'清华大学证书在线生成器','url'=>'http://120.27.225.171/makePicture/index.html'],
        ]
    ],
]);
var_dump($res);
////处理微信服务器的请求
//$response = Kernel::handle();
//
//echo $response;


/**
 * 发送音频
 */
//$res=\PFinal\Wechat\Service\MaterialService::uploadFileTemporary('voice.mp3','voice');
////var_dump($res);exit;
//$media_id=$res['media_id'];
////$media_id='1StCHovz8iNLnpVcF84bKikLxxdO1Mv1yvXI__zfcJDBn9SK0deyuul6IJbHGRO2';
//$Arr=new \PFinal\Wechat\Message\Voice($media_id);
////var_dump($Arr);exit;
//$resArr = MessageService::send($openid2,$Arr );
//var_dump($resArr);