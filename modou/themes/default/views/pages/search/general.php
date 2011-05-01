<div class="notice">
	<strong>魔豆搜索</strong><br />
	<form action="<?php echo URL::site('search'); ?>" method="post">
		<input type="text" name="q" value="<?php if(isset($query)){ echo $query; } ;?>"/>
		<br />
		<input class="button" type="submit" value="图书" name="type"/> 
		<input class="button" type="submit" value="电影" name="type" /> 
		<input class="button" type="submit" value="音乐" name="type" /> 
		<br />
		<input class="button" type="submit" value="用户" name="type" /> 
		<input class="button" type="submit" value="同城活动" name="type"/> 
	</form>
</div>

<?php if ( ! empty($loading_result)): ?>
	<?php echo $loading_result; ?>
<?php endif; ?>