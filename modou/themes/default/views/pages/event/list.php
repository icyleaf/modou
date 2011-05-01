<h1><?php echo $events->title; ?></h1>

<?php if ($events->total > 0): ?>
<small>
	<?php echo $index.' - '.($index + $max - 1).' (共有 '.$events->total.' 个活动)'; ?>
</small>
<table id="event" class="subject">
<?php 
	$i = 0;
	foreach ($events->entry as $event)
	{
		$style = ($i%2 == 0) ? 'even' : 'odd';
        $image = str_replace('mpic', 'bpic', $event->link['image']);
?>
	<tr class="<?php echo $style; ?>">
		<td class="subject"><img class="title" src="<?php echo $image; ?>" /></td>
		<td>
			<span class="book"><?php echo html::anchor('event/'.$event->id, $event->title); ?></span>
			<div class="info">
			<?php
			if ( isset($event->attribute['aka']))
			{
				echo '又名: '.$event->attribute['aka'].'<br />';
			}		
			if ( isset($event->attribute['subtitle']))
			{
				echo '副标题: '.$event->attribute['subtitle'].'<br />';
			}
			
			if ( isset($event->attribute['translator']))
			{
				echo '译者: '.$event->attribute['translator'].'<br />';
			}
			
			if ( isset($event->author) )
			{
				echo '作者: '.implode(',', $event->author).'<br />';
			}	

			if ( isset($event->attribute['publisher']))
			{
				echo '出版社: '.$event->attribute['publisher'].'<br />';
			}
			
			if ( isset($event->attribute['pubdate']))
			{
				echo '出版时间: '.$event->attribute['pubdate'].'<br />';
			}
			
			$i++;
			?>
			</div>
		</td>
	</tr>
<?php } ?>
</table>

<?php if ($events->total > 10): ?>
<div id="status">
<?php echo html::anchor(Route::get('search')->uri(array(
	'action' => Request::instance()->action,
	'query'  => $query,
	'index'  => ($index + $max),
	'max'    => $max,
	)), '下 '.$max.' 个同城活动 »'); ?>
</div>
<?php endif; ?>

<?php else: ?>
<p class="message">
	没有找到你要搜索的图书 :(<br />
	请尝试重新搜索。
</p>
<?php endif; ?>