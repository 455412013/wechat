<?php

require __DIR__ . '/vendor/autoload.php';





use PFinal\Wechat\Kernel;
use PFinal\Wechat\Message\Receive;
use PFinal\Wechat\Message;
use PFinal\Wechat\WechatEvent;
use PFinal\Wechat\Support\Log;

//配置项
$config = require __DIR__ . '/config-local.php';

//初始化
Kernel::init($config);

//消息处理
Kernel::register(Receive::TYPE_TEXT, function (WechatEvent $event) {
    $message = $event->getMessage();
    $content=$message->Content;
    $data=['key'=>'d534314d16af4fed9c39520d4a0c9d79','info'=>$content,'loc'=>'上海市黄浦区','userid'=>'1'];
    $json=json_encode($data);
    $url = "http://www.tuling123.com/openapi/api";
    $ch = curl_init ();
// print_r($ch);
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $json );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json))
    );
    $return = curl_exec ( $ch );
    $arr=json_decode($return,true);
    $response=$arr['text'];
    curl_close ( $ch );
    if($arr['code']=='100000'){
        $event->setResponse($response);
    }else{
        $event->setResponse('暂时无法回复');
    }

    $event->stopPropagation();
});

//关注事件
Kernel::register(Receive::TYPE_EVENT_SUBSCRIBE, function (WechatEvent $event) {
    $event->setResponse('你关注或是不关注，我都在这里，不悲不喜~~');
    $event->stopPropagation();
});


//点击事件
Kernel::register(Receive::TYPE_EVENT_CLICK, function (WechatEvent $event) {
    $message=$event->getMessage();
    if($message->EventKey =='jokes'){
        /**
         * 连接数据库
         */
        define("MYSQL_DSN", "mysql:dbname=wechat;host=localhost");
        define("MYSQL_USER", "root");
        define("MYSQL_PASSWORD", "8cca2cb0");

        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "set names 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        $dbh=new PDO(
            MYSQL_DSN,
            MYSQL_USER,
            MYSQL_PASSWORD,
            $options
        );
        $sql = "select * from jokes where mark_delete=0";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $rows=$sth->fetchAll(PDO::FETCH_ASSOC);
        function get_one(&$a){
            if(count($a)>=1){
                $key=array_rand($a,1);
                $value=$a[$key];
                unset($a[$key]);
                return  $value['content'];
            }else{
                return "都取光了";
            }
        }
         $jokes=get_one($rows);

        //$media_id='1StCHovz8iNLnpVcF84bKikLxxdO1Mv1yvXI__zfcJDBn9SK0deyuul6IJbHGRO2';
        //$Arr=new \PFinal\Wechat\Message\Music($media_id,1,2,3,8);
//var_dump($Arr);exit;
        //$res=\PFinal\Wechat\Service\MaterialService::uploadFileTemporary('voice.mp3','voice');
//var_dump($res);exit;
        //$media_id=$res['media_id'];
//$media_id='1StCHovz8iNLnpVcF84bKikLxxdO1Mv1yvXI__zfcJDBn9SK0deyuul6IJbHGRO2';
        $message=new \PFinal\Wechat\Message\Text($jokes);
        $event->setResponse($message);

//        $media_id='1StCHovz8iNLnpVcF84bKikLxxdO1Mv1yvXI__zfcJDBn9SK0deyuul6IJbHGRO2';
//        $result = MessageService::send($openid2, new \PFinal\Wechat\Message\Text('谢谢'));
    }elseif($message->EventKey =='news'){

        /**
         * 连接数据库
         */
        define("MYSQL_DSN", "mysql:dbname=yii;host=localhost");
        define("MYSQL_USER", "root");
        define("MYSQL_PASSWORD", "8cca2cb0");

        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "set names 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        $dbh=new PDO(
            MYSQL_DSN,
            MYSQL_USER,
            MYSQL_PASSWORD,
            $options
        );
        $sql = "select * from posts";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $rows=$sth->fetchAll(PDO::FETCH_ASSOC);
        function get_one(&$a){
            if(count($a)>=1){
                $key=array_rand($a,1);
                $value=$a[$key];
                unset($a[$key]);
                return  $value;
            }else{

            }
        }
        $article=get_one($rows);
//        $res=\PFinal\Wechat\Service\MaterialService::uploadFileTemporary('demo.jpg','image');
//        $media_id=$res['media_id'];
        $message = new \PFinal\Wechat\Message\News($article['title'], $article['summary'], 'http://www.zhengrui.club:8081/post/view?id='.$article['id'], 'http://www.zhengrui.club:8081'.$article['label_img']);
        $event->setResponse($message);    }
});

//处理微信服务器的请求
$response = Kernel::handle();

echo $response;