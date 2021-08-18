# 安装SDK

## 拉取SDK文件

SDKNAME的是使用PHP写的，因此我们的安装也非常简单，不需要导入任何的数据库，不需要额外安装什么。

现在前往 [**<font color=red>SDKNAME</font>**](http://github.com) 拉取下载文件，然后将它上传到您的服务器上。

!> 请注意，文件下载和上传到服务器您必须自己完成，当 **SDKNAME** 被成功上传到您的服务器并且绑定域名或者可以用服务器IP访问时方可进行下一步。

如果您已经确认上传好了SDK文件，那么这代表您可以继续向下开发，如果你遇到了问题，可以联系作者了解情况。

## 验证安装

为了确保您完成了安装，请现在访问您的域名，当然，如果您并没有在网站 **根目录** 安装，则需要访问对应网址路径。

> 提示
> 
> 如果你正常访问了对应路径，那么你将看到下面的返回内容。

``` json
{
	"code": 403,
	"msg": "数据非法"
}
```
请不要担心这个状态码，因为这代表你已经成功安装了！！！

那么为什么会返回403呢？ 让我们回到请求流程图，在那里会有你想要的答案。

> 如果你还没有明白
> 
> 我们为了鉴别这个请求是否来自NOKNOK，会验证verify_token令牌，当它符合才会去执行命令检测等代码


如果你得到了这个代码，代表您已经完成了SDK的安装，怎么样？是不是非常简单快捷呢？

**SDKNAME** 安装简单并非因为它的能力很小，而是因为我们得益于 **NOKNOKBOTAPI** 这极大的方便我们构建底层HTTP请求，这也会方便开发者们去构建自己的代码。

最后，如果你准备好了，请看下一节来学习配置。