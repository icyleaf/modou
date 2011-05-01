<h1>欢迎来到魔豆！</h1>
<p>
	魔豆正在升级新版本，如果需要使用同城的功能暂先访问：
	<?php echo HTML::anchor('http://v1.modou.us'); ?>
</p>
<div class="notice">
	<strong>魔豆搜索</strong><br />
	<form action="<?php echo URL::site('search'); ?>" method="post">
		<input type="text" name="q" />
		<br />
		<input class="button" type="submit" value="图书" name="type"/> 
		<input class="button" type="submit" value="电影" name="type" /> 
		<input class="button" type="submit" value="音乐" name="type" /> 
		<br />
		<input class="button" type="submit" value="用户" name="type" /> 
		<input class="button" type="submit" value="同城活动" name="type"/> 
	</form>
</div>

<hr />
<h1>登录验证是什么？</h1>
<p class="comment">
	为了保护豆瓣用户的数据，当第三方应用需要通过 API 访问或修改受保护的用户数据（例如增删用户收藏）时，
	需要通过 OAuth 认证机制来获得用户的授权。它很安全，绝不会让你的账户和密码泄露出去，请安心使用。
</p>
<p class="comment">
	唯一不方便的是，由于豆瓣网还没有对 OAuth 的验证增加移动网站的优化，
	所以点击登录验证后会跳转到豆瓣网的普通版，可能对手机的浏览造成一些影响。
</p>
<p class="comment">
	如果还没有豆瓣账户请在<a href="http://douban.com/register" target="_blank">这里</a>注册。
</p>

<hr />
<h1>魔豆是什么？</h1>
<p class="comment">
	魔豆是基于豆瓣网 API 开发的应用，专门为移动终端（手持设备）定制的豆瓣移动版本。<br />
	由最初的专注的豆瓣<strong>广播</strong>以及<strong>同城活动</strong>功能之外现在已经开放了更多的功能：
	查看书影音，全功能的搜索，收发豆邮，查看用户日志，通过 ISBN，IMDB 查找书籍和电影信息。
</p>
<p class="comment">
	唯一不足之处，因豆瓣数据保护从豆瓣 API 获得的部分数据只是摘要，而不是全文。
</p>

