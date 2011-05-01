<!DOCTYPE HTML PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xHTML-mobile10.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML" xml:lang="utf-8" lang="utf-8">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<meta name="description" content="<?php echo $config->description; ?>"/>
<meta name="description" content="<?php echo $config->keywords; ?>"/>
<?php echo $head_data; ?>
</head>
<body>
<div id="header">
	<p class="logo">
		<?php echo HTML::anchor(URL::base(FALSE), HTML::image($config->logo, array(
			'alt' => $config->title
			)));
			if ( ! $douban->logged_in())
			{
				echo '<small> | '.HTML::anchor(URL::site('auth/redirect'), '登录验证').'</small>';
			}
		?>
	</p>
</div><!-- /header -->
<div class="clear"></div>

<div id="content">
	<?php if (isset($content)) echo $content; ?>
</div><!-- /content -->
<div class="clear"></div>

<?php if (isset($menus) AND is_array($menus)): ?>
<div class="main">
<?php 
	foreach($menus as $link => $title) 
	{
		if (empty($link))
		{
			echo '<i>0</i>';
			echo HTML::anchor($link, $title, array('accesskey' => 0)).'<br />';
		}
		else
		{
			echo HTML::anchor($link, $title).'<br />';
		}
	}
?>
</div>
<div class="clear"></div>
<?php endif; ?>

<div id="footer">
	<?php echo HTML::anchor('http://www.douban.com', '访问普通版豆瓣', array('class' => 'button')); ?><br />
	<?php echo HTML::anchor('feedback', '意见反馈', array('class' => 'button')); ?><br />
	<?php echo Modou::copyright($config->copyright_year); ?>
</div><!-- /footer -->

<?php if ($config->ga_account_id): ?>
<!-- Google Analytics-->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("<?php echo $config->ga_account_id; ?>");
pageTracker._trackPageview();
} catch(err) {}</script>
<?php endif; ?>

</body>
</HTML>