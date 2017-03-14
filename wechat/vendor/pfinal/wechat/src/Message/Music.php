<?php

namespace PFinal\Wechat\Message;

use PFinal\Wechat\Contract\SendMessage;
use PFinal\Wechat\Contract\ReplyMessage;

class Music implements ReplyMessage, SendMessage
{
    protected $type = 'music';
    protected $attributes;

    public function __construct($thumbMediaId, $title = '', $description = '', $musicUrl = '', $hqMusicUrl = '')
    {
        if (is_array($thumbMediaId)) {
            extract($thumbMediaId, EXTR_OVERWRITE);
        }

        $this->attributes = array(
            'Music' => array(
                'Title' => $title,
                'Description' => $description,
                'MusicUrl' => $musicUrl,
                'HQMusicUrl' => $hqMusicUrl,
                'Thumb_Media_Id' => $thumbMediaId,
            )
        );
//        var_dump($this->attributes );exit;
    }

    /**
     * @return array
     */
    public function xmlData()
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function jsonData()
    {
        $music = array();
        //array(5) { ["Title"]=> int(1) ["Description"]=> int(2) ["MusicUrl"]=> int(3) ["HQMusicUrl"]=> int(6) ["ThumbMediaId"]=> string(64) "1StCHovz8iNLnpVcF84bKikLxxdO1Mv1yvXI__zfcJDBn9SK0deyuul6IJbHGRO2" }
//        var_dump($this->attributes['Music'] );exit;
        //将key转为小写，微信json格式为全小写
       $music= array_change_key_case($this->attributes['Music'],CASE_LOWER);
//        foreach ($this->attributes['Music'] as $k => $v) {
//            $music[$k] = array_change_key_case($v, CASE_LOWER);
//        }

        return array('music' => $music);
    }
}