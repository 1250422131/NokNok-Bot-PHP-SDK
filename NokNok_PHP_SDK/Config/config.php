<?php

/** 
 * config.php 
 * 
 * NokBot的重要机器人设置配置文件，请务必认真填写数据，全体文件都需要使用它，内容基本写死，因此就不写成类了，需要的文件拉取直接用
 * 
 * @author 萌新杰少 <imcys.com> <1250422131@qq.com> <NokNok B站同名>
 * @version 1.0 
 * @package config 
 *
 */

/** 
 * 请求地址 全局变量 -> 更多接口请在这里直接全局配置，这是未来维护简单和方便调用 因为内容基本不改动，这里就不写类了，后面直接引入调用
 * @global string $GLOBALS['NokRequestUrl'] 
 * @global string $GLOBALS['BotToken'] 
 * @global string $GLOBALS['VerifyToken'] 
 * @global string $GLOBALS['SendGroupMessage'] 
 * @global string $GLOBALS['GetGroupInfo'] 
 * @global string $GLOBALS['GetGroupChannelList'] 
 * @global string $GLOBALS['CheckUserHasPerm'] 
 * @global string $GLOBALS['CommReport'] 
 * 
 * @name $NokRequestUrl Nok机器人请求地址
 * @name $VerifyToken Nok机器人验证Token
 * @name $BotToken 机器人Token
 * @name $SendGroupMessage 消息发送请求rl
 * @name $GetGroupInfo 获取群组信息Url
 * @name $GetGroupChannelList 获取群组频道列表Url
 * @name $CheckUserHasPerm 判断用户是否有权限Url
 * @name $CommReport 通用数据上报Url
 */

//请填写下自己的 机器人令牌 和 验证令牌 以及 机器人UID
$GLOBALS['BotToken'] = '';
$GLOBALS['VerifyToken'] = '';
$GLOBALS['BotUid'] = "";

//API配置区域别乱改，当然你可以增加一些你自己的API，但不推荐在这里，这里仅仅为官方API留接口，以免混淆
$GLOBALS['NokRequestUrl'] = 'https://openapi.noknok.cn';
$GLOBALS['SendGroupMessage'] = $NokRequestUrl . '/api/v1/SendGroupMessage';
$GLOBALS['GetGroupInfo'] = $NokRequestUrl . '/api/v1/GetGroupInfo';
$GLOBALS['GetGroupChannelList'] = $NokRequestUrl . '/api/v1/GetGroupChannelList';
$GLOBALS['CheckUserHasPerm'] = $NokRequestUrl . '/api/v1/CheckUserHasPerm';
$GLOBALS['CommReport'] = $NokRequestUrl . '/api/v1/CommReport';



