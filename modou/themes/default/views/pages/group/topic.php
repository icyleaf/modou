<div class="notice">仅作浏览，无法回应</div>
<h1><?php echo $title; ?></h1>
<?php
	$thumb = 'avatar';
	$mobile = Request::user_agent('mobile');
	if ($mobile AND $mobile != 'iPhone')
	{
		$thumb = 'avatar_mobile';
	}
?>
<table id="topic" class="subject">
	<tr>
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $avatar; ?>" /></td>
		<td>
			<span class="collection">
				<?php echo $author; ?><br />
				<small><?php echo $date.' ('.Modou::time_ago(strtotime($date)).')'; ?></small>
			</span>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="info"><?php echo $content; ?></td>
	</tr>
</table>
<div class="notice">仅作浏览，无法回应</div>