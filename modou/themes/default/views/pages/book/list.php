<h1><?php echo $books->title; ?></h1>

<?php if ($books->total > 0): ?>
<small>
	<?php echo $index.' - '.($index + $max - 1).' (共有 '.$books->total.' 本图书)'; ?>
</small>
<table id="book" class="subject">
<?php 
	$i = 0;
	foreach ($books->entry as $book)
	{
		//TODO: Douban API书音的 attribute 有丢失
		$style = ($i%2 == 0) ? 'even' : 'odd';
        $image = str_replace('mpic', 'spic', $book->link['image']);
        $thumb = 'subject';
        $mobile = Request::user_agent('mobile');
        if ($mobile AND $mobile != 'iPhone')
        {
            $thumb = 'subject_mobile';
        }
?>
	<tr class="<?php echo $style; ?>">
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $image; ?>" /></td>
		<td>
			<span class="book"><?php echo html::anchor('book/'.$book->id, $book->title); ?></span>
			<div class="info">
			<?php
			if (isset($book->attribute['aka']))
			{
				echo '又名: '.$book->attribute['aka'].'<br />';
			}		
			if (isset($book->attribute['subtitle']))
			{
				echo '副标题: '.$book->attribute['subtitle'].'<br />';
			}
			
			if (isset($book->attribute['translator']))
			{
				echo '译者: '.$book->attribute['translator'].'<br />';
			}
			
			if (isset($book->author) )
			{
				echo '作者: '.implode(', ', $book->author).'<br />';
			}	

			if (isset($book->attribute['publisher']))
			{
				echo '出版社: '.$book->attribute['publisher'].'<br />';
			}
			
			if (isset($book->attribute['pubdate']))
			{
				echo '出版时间: '.$book->attribute['pubdate'].'<br />';
			}
			
			$i++;
			?>
			</div>
		</td>
	</tr>
<?php } ?>
</table>

<?php if ($books->total > 10): ?>
<div id="status">
<?php echo html::anchor(Route::get('search')->uri(array(
	'action' => Request::instance()->action,
	'query'  => $query,
	'index'  => ($index + $max),
	'max'    => $max,
	)), '下 '.$max.' 本书 »'); ?>
</div>
<?php endif; ?>

<?php else: ?>
<p class="message">
	没有找到你要搜索的图书 :(<br />
	请尝试重新搜索。
</p>
<?php endif; ?>