<h1><?php echo $peoples->title; ?></h1>

<?php if ($peoples->total > 0): ?>
<small>
	<?php echo $index.' - '.($index + $max - 1).' (共有 '.$peoples->total.' 位用户)'; ?>
</small>
<table id="people" class="subject">
<?php 
	$i = 0;
	foreach ($peoples->entry as $people)
	{
		$style = ($i%2 == 0) ? 'even' : 'odd';
        $thumb = 'avatar';
        $mobile = Request::user_agent('mobile');
        if ($mobile AND $mobile != 'iPhone')
        {
            $thumb = 'avatar_mobile';
        }
?>
	<tr class="<?php echo $style; ?>">
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $people->link['icon']; ?>" /></td>
		<td>
			<span class="book"><?php echo html::anchor('people/'.$people->id, $people->nick); ?></span>
			<div class="info">
			<?php
			if (isset($people->location))
			{
				echo '居住地: '.$people->location['title'].'<br />';
			}
			
			if (isset($people->link['homepage']))
			{
				echo TEXT::auto_link($people->link['homepage']).'<br />';
			}
			
			$i++;
			?>
			</div>
		</td>
	</tr>
<?php } ?>
</table>

<?php if ($peoples->total > 10): ?>
<div id="status">
<?php if (Request::instance()->controller == 'search'): ?>
	<?php echo html::anchor(Route::get('search')->uri(array(
		'action' => Request::instance()->action,
		'query'  => $query,
		'index'  => ($index + $max),
		'max'    => $max,
		)), '下 '.$max.' 位用户 »'); ?>
<?php elseif (Request::instance()->controller == 'event'): ?>
	<?php echo html::anchor(Route::get('event')->uri(array(
		'action' => Request::instance()->action,
		'id'     => Request::instance()->param('id'),
		'index'  => ($index + $max),
		'max'    => $max,
		)), '下 '.$max.' 位用户 »'); ?>
<?php else: ?>
	<?php echo html::anchor(Route::get('people')->uri(array(
		'action' => Request::instance()->action,
		'id'     => Request::instance()->param('id'),
		'index'  => ($index + $max),
		'max'    => $max,
		)), '下 '.$max.' 位用户 »'); ?>
<?php endif; ?>
</div>
<?php endif; ?>

<?php else: ?>
<p class="message">
	没有找到你要搜索的用户 :(<br />
	请尝试重新搜索。
</p>
<?php endif; ?>