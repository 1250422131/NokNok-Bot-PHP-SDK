# 引用接口

## 接口模板

现在请打开 **Plugin** 文件夹，在这里我们还可以看到 **NokInterface.php** 文件，顾名思义，它就是插件采用的模板。

```php
<?php
namespace NokNok;
//定义一个接口
interface NokInterface
{
    //文本信息接受
    public function textMsgDic(".....");

    //Markdown消息接受
    public function markdownMsgDic(".....");
    
    //接受视频消息
    public function videoInfoMsgDic(".....");

    //接受图片消息
    public function picMsgDic(".....");
}
```
### 为什么采用模板？

为了规范大家的插件，做到数据互通，请务必在您的插件类引入这个接口，使得您的插件可以在不改变接口的情况下直接通过替换类名来做到引入新的插件。

!> 请注意，如果您一定要自定义接口，那么其他人要使用时，您必须要将接口文件也发给对方，或者您可以不采用接口。

> 接口提示
> 
> 如果您的插件引入了这个接口，则您的插件类必须要有这些方法，否则会报错。

## 创建新插件

```php
<?php
namespace NokNok;
include './Plugin/NokInterface.php';
use NokNok\NokInterface;

class Dictionary extends FileUtils implements NokInterface
{

    var "......";


    public function  __construct("......")
    {

    }

    //$content 用户消息
    public function textMsgDic("......")
    {

    }

    //$content Markdown消息
    public function markdownMsgDic("......")
    {
    }

    /**
     * 接受视频消息
     * 详细参数内容见
     * https://bot-docs.github.io/pages/events/1_callback.html#2%E8%A7%86%E9%A2%91%E6%B6%88%E6%81%AF
     */
    public function videoInfoMsgDic("......")
    {
    }

    /**
     * 接受图片消息
     * 详细参数内容见，请务必查看这个图片有可能不只有一个
     * https://bot-docs.github.io/pages/events/1_callback.html#3%E5%9B%BE%E7%89%87%E6%B6%88%E6%81%AF
     */
    public function picMsgDic("......")
    {
    }

}
```
如果您不需要我们的插件，需要自定义插件，或者编写新的插件，则您可以自定义一个插件。

为了区分您的类和我们官方的类不冲突，则您需要自己定义一个命名空间

在其他类使用您的类时同样需要引入，需要注意的是 namespace 空间命名; 必须在第一行，在use前必须 include 等函数引入这个类，否则将会报错。

```php
namespace 空间命名;
include './Plugin/NokInterface.php';
use 空间命名\类名;
```

## 插件引入

还记得插件配置吗？


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

其中 **<font color=red>$Dictionary = new Dictionary("......");</font>**  实际上是在将类初始化，这就是插件引入的第一步。

**<font color=red>$Dictionary->textMsgDic("......")</font>** 就是在实现类中的方法，也是让插件起到作用。

最后，您已经了解了简单的插件写法，现在可以创建简单的插件给其他开发者使用，也欢迎开源您的插件，或者将好的想法告诉我们。

