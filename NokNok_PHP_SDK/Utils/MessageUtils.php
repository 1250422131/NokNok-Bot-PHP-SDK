<?php

namespace NokNok;

include './Utils/HttpUtils.php';

use NokNok\HttpUtils;

class MessageUtils extends HttpUtils
{
    var $gid;
    var $target_id;

    //7.0构造函数，不能和类同名，PHP即将弃用同名类作为构造函数
    public function  __construct($gid, $target_id)
    {
        $this->gid = $gid;
        $this->target_id = $target_id;
    }

    // Msg -> Message
    public function sendTextMessage($Msg)
    {

        $array = [
            'gid' => $this->gid,
            'target_id' => $this->target_id,
            'l2_type' => 1,
            'ts' => time(),
            'nonce' => round(0, 100) . "",
            'body' => [
                'content' => $Msg
            ]
        ];

        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        //$HttpUtils = new HttpUtils();
        //继承了父类方法，直接在当前对象调用这个方法 HttpUtils::NokPost 和 this->NokPost($value)一模一样的
        $result = HttpUtils::NokPost($postData, $GLOBALS['SendGroupMessage']);
        return json_decode($result, true);
    }


    //发送Markdown
    public function sendMarkdown($markdown)
    {


        $array = [
            'gid' => $this->gid,
            'target_id' => $this->target_id,
            'l2_type' => 8,
            'ts' => time(),
            'nonce' => round(0, 100) . "",
            'body' => [
                'content' => $markdown
            ]
        ];

        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        $result = HttpUtils::NokPost($postData, $GLOBALS['SendGroupMessage']);
        return json_decode($result, true);
    }




    //信息回复
    public function sendTextReply($Msg, $uid_replied, $content, $msg_id)
    {
        $array = [
            'gid' => $this->gid,
            'target_id' => $this->target_id,
            'l2_type' => 1,
            'l3_types' => [1],
            'ts' => time(),
            'nonce' => round(0, 100) . "",
            //配置回复消息
            'body' => [
                'reply_msg' => [
                    'content' => "      " . $content,
                    'uid_replied' => "$uid_replied",
                    'msg_seq' => "$msg_id",
                    'msg_id' => ""
                ],
                'content' => $Msg
            ]
        ];
        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        $result = HttpUtils::NokPost($postData, $GLOBALS['SendGroupMessage']);
        return json_decode($result, true);
    }




    public function sendMarkdownReply($markdown, $uid_replied, $content, $msg_id)
    {
        $array = [
            'gid' => $this->gid,
            'target_id' => $this->target_id,
            'l2_type' => 8,
            'l3_types' => [1],
            'ts' => time(),
            'nonce' => round(0, 100) . "",
            //配置回复消息
            'body' => [
                'reply_msg' => [
                    'content' => "      " . $content,
                    'uid_replied' => "$uid_replied",
                    'msg_seq' => "$msg_id",
                    'msg_id' => ""
                ],
                'content' => $markdown
            ]
        ];
        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        $result = HttpUtils::NokPost($postData, $GLOBALS['SendGroupMessage']);
        return json_decode($result, true);
    }


    //@信息
    public function sendTextAt(String $Msg, int $at_type, array $at_uid_list)
    {
        $array = [
            'gid' => $this->gid,
            'target_id' => $this->target_id,
            'l2_type' => 1,
            'l3_types' => [3],
            'ts' => time(),
            'nonce' => round(0, 100) . "",
            //配置回复消息
            'body' => [
                'at_msg' => [
                    'at_type' => $at_type,
                    'at_uid_list' => $at_uid_list
                ],
                'content' => $Msg
            ]
        ];
        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        $result = HttpUtils::NokPost($postData, $GLOBALS['SendGroupMessage']);
        return json_decode($result, true);
    }


    //@信息
    public function sendMarkdownAt(String $Msg, int $at_type, array $at_uid_list)
    {
        $array = [
            'gid' => $this->gid,
            'target_id' => $this->target_id,
            'l2_type' => 8,
            'l3_types' => [3],
            'ts' => time(),
            'nonce' => round(0, 100) . "",
            //配置回复消息
            'body' => [
                'at_msg' => [
                    'at_type' => $at_type,
                    'at_uid_list' => $at_uid_list
                ],
                'content' => $Msg
            ]
        ];
        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        $result = HttpUtils::NokPost($postData, $GLOBALS['SendGroupMessage']);
        return json_decode($result, true);
    }


    public function GetGroupInfo($gid)
    {
        $array = [
            'gid' => $gid
        ];
        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        $result = HttpUtils::NokPost($postData, $GLOBALS['GetGroupInfo']);
        return $result;
    }

    public function GetGroupChannelList($gid)
    {
        $array = [
            'gid' => $gid
        ];
        $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
        $result = HttpUtils::NokPost($postData, $GLOBALS['GetGroupChannelList']);
        return $result;
    }
}
