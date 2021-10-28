<?php
//传入数据
include './Config/config.php';
include './Utils/NokMain.php';

use NokNok\NokMain;

$update = file_get_contents('php://input');
$updateJson = json_decode($update, true);
//验证数据合法性
if ($updateJson['verify_token'] == $VerifyToken) {
    //刷新缓存 - > 下面代码全部为异步执行，即代表先返回内容再输出
    ob_end_clean();
    ob_start();
    $msgReturn = [
        'ret' => 0,
        'msg' => "ok"
    ];
    echo json_encode($msgReturn, JSON_UNESCAPED_UNICODE);
    $size = ob_get_length();
    //基本header信息
    header("HTTP/1.1 200 OK");
    header("Content-Length: $size");
    header("Connection: close");
    header("Content-Type: application/json;charset=utf-8");
    ob_end_flush();
    if (ob_get_length()) {
        ob_flush();
    }
    //输出刷新页面
    flush();
    if (function_exists("fastcgi_finish_request")) {
        fastcgi_finish_request();
    }
    //暂停1秒让NOKNOK来处理逻辑
    sleep(1);
    //让页面继续跑
    ignore_user_abort(true);
    //限制300内结束数据
    set_time_limit(300);
    //继续走逻辑
    $postData = json_encode($array, JSON_UNESCAPED_UNICODE);
    $NokMain = new NokMain($updateJson);
    $NokMain->runDic();
} else {
    header("Content-Type: application/json;charset=utf-8");
    $array = [
        'code' => 403,
        'msg' => '数据非法'
    ];
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
}




