# 信息配置

## 主要信息配置

先让我们找到 **<font color=red>Config文件夹</font>** 打开这个文件夹，里面有 **<font color=red>config.php</font>** ，没错，它就是我们配置文件。

在这个文件里，有我们SDK全局需要使用的功能，它的有用内容如下

```php

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

//请填写下自己的 机器人令牌 和 验证令牌 以及 机器人UID
$GLOBALS['BotToken'] = '机器人令牌';
$GLOBALS['VerifyToken'] = '验证令牌';
$GLOBALS['BotUid'] = "机器人UID";

//API配置区域别乱改，当然你可以增加一些你自己的API，但不推荐在这里，这里仅仅为官方API留接口，以免混淆
$GLOBALS['NokRequestUrl'] = 'noknokbotapi';
$GLOBALS['SendGroupMessage'] = $NokRequestUrl . '/api/v1/SendGroupMessage';
$GLOBALS['GetGroupInfo'] = $NokRequestUrl . '/api/v1/GetGroupInfo';
$GLOBALS['GetGroupChannelList'] = $NokRequestUrl . '/api/v1/GetGroupChannelList';
$GLOBALS['CheckUserHasPerm'] = $NokRequestUrl . '/api/v1/CheckUserHasPerm';
$GLOBALS['CommReport'] = $NokRequestUrl . '/api/v1/CommReport';

```

下面我介绍一下这些全局参数的含义

| 参数名称            |        代表意义        |
| ------------------- | :--------------------: |
| BotToken            |       机器人令牌       |
| VerifyToken         |        验证令牌        |
| BotUid              |       机器人UID        |
| NokRequestUrl       |  NOKNOKBOT的API主地址  |
| SendGroupMessage    |    消息发送请求路径    |
| GetGroupInfo        |    获取群组信息路径    |
| GetGroupChannelList |  获取群组频道列表路径  |
| CheckUserHasPerm    | 判断用户是否有权限路径 |
| CommReport          |    通用数据上报路径    |


我们需要配置的参数非常简单，我们只需要配置下面的参数，因为其他的我已经帮助您配置好了

| 参数名称    |  代表意义  |
| ----------- | :--------: |
| BotToken    | 机器人令牌 |
| VerifyToken |  验证令牌  |
| BotUid      | 机器人UID  |

这一步配置好，之后就完成了基本内容，下面，我们来继续简单的信息收发。

## 插件配置


现在请打开 **Utils文件夹** ，我来为您介绍一下，Utils为工具类，在这里来配置你插件需要的工具类。目前SDK给您了三个必须类，和一个常用类。

| 文件名称         |    代表功能    |
| ---------------- | :------------: |
| HttpUtils.php    |   底层请求类   |
| MessageUtils.php |   信息发送类   |
| NokMain.php      | 消息接受分发类 |

我们主要来看看 **NokMain.php** 这个文件，让我们先看看插件是如何运作的

如你所见，想要导入一个插件，必须要在最前面导入这个类，并且use来引入命名空间的类

并且你需要在，下面关键位置配置对应插件的入口

!> 所谓插件，实际上是一个PHP的类，在类里可以编写对应的分发，来在这里调用。下面代码是简化过的

```php
if ($Json['signal'] == '1') {
    //插件实例化
    $Dictionary = new Dictionary("......");
    //判断是否为机器人消息
    if ($Json['data'][$i]['sender_uid'] != $GLOBALS['BotUid']) {
        //消息内容类型 1:文本消息,2:视频消息，3:图片消息,4:文件消息,5:音频消息,6:信令消息,7:富文本消息8:markdown消息,9:卡片消息,10:系统消息,11:表情消息,12混合消息,13互动消息
        if ($Json['data'][$i]['l2_type'] == '1') {

                $Dictionary->textMsgDic("......");

            } elseif ($Json['data'][$i]['l2_type'] == '2') {

                $Dictionary->videoInfoMsgDic("......");

            } elseif ($Json['data'][$i]['l2_type'] == '3') {

                $Dictionary->picMsgDic("......");

            }
        }
            
    }
}
```


了解方法之后，我们就可以开始编写插件内容了，我们为您提供了一个插件模板，你可以直接使用它，或者编写新的模板，编写教程会在后面解释。

现在请打开 **Plugin文件夹** ，我来为您介绍一下，找到 **Dictionary.php** 文件。

> 下面我们简单举个例子
> 
> 我们在 textMsgDic 方法当中判断了消息内容，并且通过 sendTextMessage 发送了一条消息

```php
<?php
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
        if ($content == "菜单") {

            $Msg = "你也好";
            //简单信息发送
            $this->MessageUtils->sendTextMessage($Msg);
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
    public function videoInfoMsgDic(...)
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

}
```

同样的，你可以在对应的入口，仿照上述代码，编写功能，因此，如果你使用了 SDKNAME 自带的模板，那么你必须在这里对应方法下判断消息，做出应答。

至此你已经学会了简单的消息收发配置，现在试着编写一些简单的代码，消息收发。

下面我将为您介绍插件的编写，当这些介绍完后，我们再回过头来介绍markdown格式消息发送，等其他的特殊消息发送。






