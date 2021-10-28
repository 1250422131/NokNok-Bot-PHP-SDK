<?php

namespace NokNok;

include './Utils/FileUtils.php';
include './Utils/MessageUtils.php';
include './Plugin/NokInterface.php';

//命名空间引入
use NokNok\FileUtils;
use NokNok\MessageUtils;
use NokNok\NokInterface;

class Dictionary extends FileUtils implements NokInterface
{

    var $type;
    var $scope;
    var $MessageUtils;
    var $Json;
    var $sender_uid;

    public function  __construct($type, $scope, $gid, $target_id, $sender_uid, $Json)
    {

        $this->type = $type;
        $this->scope = $scope;
        $this->MessageUtils = new MessageUtils($gid, $target_id);
        $this->sender_uid = $sender_uid;
        $this->Json = $Json;
    }

    //$content 用户消息
    public function textMsgDic($content)
    {
        //引入


        //AT消息
        if ($this->Json['data'][0]['l3_types'][0] == "3") {
            $th = $this->getSubstr($content, "@", ")");
            $content = str_replace("@" . $th . ")", "", $content);
        }
        $msgID = explode("_", $this->Json['data'][0]['msg_id']);

        //回复消息 这是一条被恢复的消息
        if ($this->Json['data'][0]['l3_types'][0] == "1") {
            $botMsg = $this->Json['data'][0]['body']['reply_msg']['content'];
        } else {

            if ($content == "测试") {

                $MsgArray = array(
                    '#### 御坂妹妹 -> 测试任务',
                );
                $Msg = $this->lineFeedMarkdown($MsgArray);

                $this->MessageUtils->sendMarkdownReply($Msg, $this->sender_uid, $content, $msgID[2]);
            }
        }
    }



    //$content Markdown消息
    public function markdownMsgDic($content)
    {
    }

    /**
     * 接受视频消息
     * 详细参数内容见
     * https://bot-docs.github.io/pages/events/1_callback.html#2%E8%A7%86%E9%A2%91%E6%B6%88%E6%81%AF
     */
    public function videoInfoMsgDic($video_url, $video_size, $video_second, $video_format, $thumb_url, $thumb_size, $thumb_width, $thumb_height, $thumb_format, $video_width, $video_height)
    {
    }

    /**
     * 接受图片消息
     * 详细参数内容见，请务必查看这个图片有可能不只有一个
     * https://bot-docs.github.io/pages/events/1_callback.html#3%E5%9B%BE%E7%89%87%E6%B6%88%E6%81%AF
     */
    public function picMsgDic($pic_info)
    {
    }




    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
        $tmpInfo = curl_exec($curl);
        curl_close($curl);

        return $tmpInfo;
    }

    //提供两个Markdown格式化类 原创
    private function chartMarkdown(array $strList)
    {
        $result = "";
        for ($i = 0; $i < sizeof($strList); $i++) {
            $result = $result . $strList[$i] . "\r\n";
        }

        return $result;
    }

    private function lineFeedMarkdown(array $strList)
    {
        $result = "";
        for ($i = 0; $i < sizeof($strList); $i++) {
            $result = $result . $strList[$i] . "\r\n\r\n";
        }

        return $result;
    }


    private function  getSubstr($str, $leftStr, $rightStr)
    {
        $left = strpos($str, $leftStr);
        //echo '左边:'.$left;
        $right = strpos($str, $rightStr, $left);
        //echo '<br>右边:'.$right;
        if ($left < 0 or $right < $left) return '';
        return substr($str, $left + strlen($leftStr), $right - $left - strlen($leftStr));
    }
}
