<h1><?php echo $musics->title; ?></h1>

<?php if ($musics->total > 0): ?>
<small>
	<?php echo $index.' - '.($index + $max - 1).' (共有 '.$musics->total.' 张专辑)'; ?>
</small>
<table id="music" class="subject">
<?php 
	$i = 0;
	foreach ($musics->entry as $music)
	{
		$style = ($i%2 == 0) ? 'even' : 'odd';
        $thumb = 'subject';
        $mobile = Request::user_agent('mobile');
        if ($mobile AND $mobile != 'iPhone')
        {
            $thumb = 'subject_mobile';
        }
?>
	<tr class="<?php echo $style; ?>">
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $music->link['image']; ?>" /></td>
		<td>
			<span class="book"><?php echo html::anchor('music/'.$music->id, $music->title); ?></span>
			<div class="info">
			<?php
			if ( isset($music->author) )
			{
				echo '表演者: '.implode(',', $music->author).'<br />';
			}
            
            if ( isset($music->attribute['isrc']) )
			{
				echo '发行条码: '.$music->attribute['isrc'].'<br />';
			}	

			if ( isset($music->attribute['pubdate']))
			{
				echo '发行时间: '.$music->attribute['pubdate'].'<br />';
			}

            if ( isset($music->attribute['publisher']))
			{
				echo '出版者: '.$music->attribute['publisher'].'<br />';
			}
			
			$i++;
			?>
			</div>
		</td>
	</tr>
<?php } ?>
</table>

<?php if ($musics->total > 10): ?>
<div id="status">
<?php echo html::anchor(Route::get('search')->uri(array(
	'action' => Request::instance()->action,
	'query'  => $query,
	'index'  => ($index + $max),
	'max'    => $max,
	)), '下 '.$max.' 张专辑 »'); ?>
</div>
<?php endif; ?>

<?php else: ?>
<p class="message">
	没有找到你要搜索的图书 :(<br />
	请尝试重新搜索。
</p>
<?php endif; ?>