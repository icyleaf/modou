<!DOCTYPE HTML PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xHTML-mobile10.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML" xml:lang="utf-8" lang="utf-8">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<meta name="description" content="<?php echo $config->description; ?>"/>
<meta name="description" content="<?php echo $config->keywords; ?>"/>
<?php echo $head_data; ?>
</head>
<body>
<div id="content">
	<?php if (isset($content)) echo $content; ?>
</div><!-- /content -->
<div class="clear"></div>
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