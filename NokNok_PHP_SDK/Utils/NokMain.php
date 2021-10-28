<?php

//这个类是NokBot的入口类，所有的请求都会被这个类接手，然后分别转发给类的其他位置，因此
namespace NokNok;
include './Plugin/Dictionary.php';
use NokNok\Dictionary;
class NokMain
{
    var $Json;

    public function __construct($Json)
    {
        $this->Json = $Json;
    }

    public function runDic()
    {
        $Json = $this->Json;
        //$Dictionary = new Dictionary($Json['data'][0]['type'], $Json['data'][0]['scope'], $Json['data'][0]['gid'], $Json['data'][0]['target_id']);
        // 消息类型,1:消息 ,2:心跳;3:加群;4:退群
        for ($i = 0; $i < sizeof($Json['data']); $i++) {
            if ($Json['signal'] == '1') {
                //插件类的初始化 你的插件需要在这里
                $Dictionary = new Dictionary($Json['data'][$i]['type'], $Json['data'][$i]['scope'], $Json['data'][$i]['gid'], $Json['data'][$i]['target_id'], $Json['data'][$i]['sender_uid'], $Json);
                
                //判断是否为机器人消息
                if ($Json['data'][$i]['sender_uid'] != $GLOBALS['BotUid']) {
                    //消息内容类型 1:文本消息,2:视频消息，3:图片消息,4:文件消息,5:音频消息,6:信令消息,7:富文本消息8:markdown消息,9:卡片消息,10:系统消息,11:表情消息,12混合消息,13互动消息
                    if ($Json['data'][$i]['l2_type'] == '1') {
                        //发送信息
                        $Dictionary->textMsgDic($Json['data'][$i]['body']['content']);
                    } elseif ($Json['data'][$i]['l2_type'] == '2') {
                        $video_url = $Json['data'][$i]['body']['video_info']['video_url'];
                        $video_size = $Json['data'][$i]['body']['video_info']['video_size'];
                        $video_second = $Json['data'][$i]['body']['video_info']['video_second'];
                        $video_format = $Json['data'][$i]['body']['video_info']['video_format'];
                        $thumb_url = $Json['data'][$i]['body']['video_info']['thumb_url'];
                        $thumb_size = $Json['data'][$i]['body']['video_info']['thumb_size'];
                        $thumb_width = $Json['data'][$i]['body']['video_info']['thumb_width'];
                        $thumb_format = $Json['data'][$i]['body']['video_info']['thumb_format'];
                        $thumb_height = $Json['data'][$i]['body']['video_info']['thumb_height'];
                        $video_width = $Json['data'][$i]['body']['video_info']['video_width'];
                        $video_height = $Json['data'][$i]['body']['video_info']['thumb_height'];
                        $Dictionary->videoInfoMsgDic($video_url, $video_size, $video_second, $video_format, $thumb_url, $thumb_size, $thumb_width, $thumb_height, $thumb_format, $video_width, $video_height);
                    } elseif ($Json['data'][$i]['l2_type'] == '3') {
                        $pic_info = $Json['data'][$i]['body']['pic_info'];
                        //类型是array 
                        $Dictionary->picMsgDic($pic_info);
                    }
                }
            }
        }
    }
}
