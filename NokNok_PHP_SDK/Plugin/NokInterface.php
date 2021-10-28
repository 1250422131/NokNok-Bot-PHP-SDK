<?php

namespace NokNok;
//定义一个数据接口
interface NokInterface
{
    //文本信息接受
    public function textMsgDic($content);

    //Markdown消息接受
    public function markdownMsgDic($content);

    //接受视频消息
    public function videoInfoMsgDic($video_url, $video_size, $video_second, $video_format, $thumb_url, $thumb_size, $thumb_width, $thumb_height, $thumb_format, $video_width, $video_height);

    //接受图片消息
    public function picMsgDic($pic_info);

    
}
