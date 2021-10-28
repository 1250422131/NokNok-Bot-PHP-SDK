<?php

namespace NokNok;
class HttpUtils
{

    public function NokPost($post, $url)
    {

        //规定需传
        $headers = array(
            "Content-Type:application/json",
            'Authorization:' . $GLOBALS['BotToken'],
            'Content-Length:' . strlen($post)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        //预留方法
        //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

        //下面接口直接JSON格式对象化了
        return json_decode($result);
    }

    public function NokGet($url)
    {
        $headers = array(
            "Content-Type:application/json",
            'Authorization:' . $GLOBALS['BotToken']
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}
