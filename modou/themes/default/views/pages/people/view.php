<?php
//echo Kohana::debug($people);
$related_url = array();

//$related_url[] = HTML::anchor(Route::get('doumail/action')->uri(array(
//	'action' => 'write',
//	'id'     => $people->id,
//	)), '发豆邮');

$related_url[] = HTML::anchor(Route::get('people')->uri(array(
	'action' => 'friends',
	'id'     => $people->id,
	)), 'TA的朋友');
	
$related_url[] = HTML::anchor(Route::get('people')->uri(array(
	'action' => 'contacts',
	'id'     => $people->id,
	)), 'TA关注的人');

$thumb = 'avatar';
$mobile = Request::user_agent('mobile');
if ($mobile AND $mobile != 'iPhone')
{
    $thumb = 'avatar_mobile';
}
?>
<table id="people" class="subject">
	<tr>
		<td class="<?php echo $thumb; ?>"><?php echo HTML::image($people->link['icon']); ?></td>
		<td>
			<?php echo HTML::anchor($people->link['alternate'], $people->name); ?>
			(<?php echo $people->nick; ?>)
			<div class="info">
				<?php if (isset($people->location)): ?>
				居住地: <?php echo $people->location['title']; ?><br />
				<?php endif; ?>
			</div>
		</td>
	</tr>
	<tr class="separate"><td colspan="2">
		<?php echo implode(' / ', $related_url); ?>
	</td></tr>
	<?php if (isset($people->content)): ?>
	<tr><td colspan="2">
		<div class="info"><?php echo TEXT::auto_p(TEXT::auto_link($people->content)); ?></div>
	</td></tr>
	<?php endif; ?>

	<?php if (isset($people->signature)): ?>
	<tr class="separate"><td colspan="2">
		签名：<?php echo $people->signature; ?>
	</td></tr>
	<?php endif; ?>
</table>