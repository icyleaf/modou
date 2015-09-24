# Modou - 魔豆

> 项目**不再**维护开发。

魔豆是基于豆瓣网 API 开发的应用，专门为移动终端定制的豆瓣移动版本。 和以往常见的豆瓣应用不太一样，魔豆专注于豆瓣的广播以及同城活动功能。

此项目发起于豆瓣一直没有发布移动版本，而本人常常流窜于豆瓣同城的各个角落，于是“魔豆”就开始萌芽了...

Douban mobile 英文简化为 moDou 而得“魔豆”此中文名。

这是一个在没有官方移动版本之前的产物。

> 因官方移动版已经上线，该项目停止开发！

## 安装需求

* [PHP](http://php.net) 5.2.8+ (支持 curl 模块)
* [Mysql](http://mysql.com) 5.0+
* [Kohana](http://github.com/kohana/kohana) v3.0.x - 一款纯 PHP 5 框架，它的特点就是**高安全性**，**轻量级代码**，**容易使用**。
* Kohana 模块: [Database](http://github.com/kohana/database), [Sprig](http://github.com/sittercity/sprig), [Pagination](http://github.com/kohana/pagination) 和 [Douban](http://github.com/icyleaf/douban)。

## 安装步骤

步骤 0: 部署 Kohana v3.0.x

下载并安装 Kohana v3.0.x 的过程，请大家参考此教程：[使用 Git 部署 Kohana 系统](http://kohanaframework.org/3.0/guide/kohana/tutorials/git)

> 此项目基于 Kohana v3.0.x 开发（不要使用 v2.x 或 v3.1.x）

步骤 1: 更新 Kohana 模块

你可以在部署完毕的 Kohana 系统的根目录执行下面操作：

	$ git submodule update --init

步骤 2: 配置 Mysql 数据库

编辑 `core/module/modou/config/database.php` 数据库配置文件:

> `$development` 开发环境的数据库配置

> `$production` 产品环境的数据库配置

导入 `dump/install.sql` 路径的 SQL 语句。

步骤 3: 应用配置

想要程序运行首先需要一个豆瓣 API Key，并在 `core/module/modou/config/douban.php` 相应的位置填充:

	/**
	 * Douban API
	 * 
	 * @param api_key	API Key
	 * @param api_secret	API Secret
	 */
	'api_key'	=> '',
	'api_secret'	=> '',

 > 支持 Google Analytics

# 福利 - 豆瓣 API 测试平台

除了魔豆的源码本身以外，还附赠了豆瓣 API 测试平台的源码，如果想尝试的话，同样需求一个豆瓣 API Key，配置文件位于：`modou/console/config/console.php`

 > 可调用的 API 列表也在上面的配置文件之中。

对于**豆瓣 API 测试平台**已知的问题：

* API 的调用参数是通过 init.php 的 Route 引导，假如传的参数是特殊字符，可能会存在接口调用错误，或者数据发送成功但因为特殊字符其后面传的内容没有发送。


## 祝你开发顺利！

如果任何疑问，请本项目中提交 Issue 或者给我发邮件：`icyleaf.cn@gmail.com`

05/01/2011

