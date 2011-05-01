<?php
//echo Kohana::debug($note);
$thumb = 'avatar';
$mobile = Request::user_agent('mobile');
if ($mobile AND $mobile != 'iPhone')
{
    $thumb = 'avatar_mobile';
}

$author = $note->author;
?>
<h1><?php echo $note->title; ?></h1>
<table id="note" class="subject">
	<tr>
		<td class="<?php echo $thumb; ?>"><?php echo HTML::image($author->link['icon']); ?></td>
		<td>
			<?php echo HTML::anchor($author->link['alternate'], $author->name); ?>
			<div class="info">
				发布: <?php echo date('Y-m-d H:i', $note->published); ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="info"><?php echo Text::auto_p($note->content); ?></td>
	</tr>
</table>