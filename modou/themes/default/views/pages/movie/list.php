<h1><?php echo $movies->title; ?></h1>

<?php if ($movies->total > 0): ?>
<small>
	<?php echo $index.' - '.($index + $max - 1).' (共有 '.$movies->total.' 部电影)'; ?>
</small>
<table id="movie" class="subject">
<?php 
	$i = 0;
	foreach ($movies->entry as $movie)
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
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $movie->link['image']; ?>" /></td>
		<td>
			<span class="book"><?php echo html::anchor('movie/'.$movie->id, $movie->title); ?></span>
			<div class="info">
			<?php
//            echo Kohana::debug($movie);
            if (isset($movie->author))
			{
				echo '导演: ';
                if (Request::instance()->controller == 'search')
                {
                    if (is_array($movie->author))
                    {
                         echo $movie->author[0].' 等';
                    }
                    else
                    {
                        echo $movie->author;
                    }
                }
                else
                {
                    echo implode(' / ', $movie->author);
                }
                echo '<br />';
			}
			if (isset($movie->attribute['cast']))
			{
				echo '主演: ';
                if (Request::instance()->controller == 'search')
                {
                    if (is_array($movie->attribute['cast']))
                    {
                         echo $movie->attribute['cast'][0].' 等';
                    }
                    else
                    {
                        echo $movie->attribute['cast'];
                    }
                }
                else
                {
                    echo implode(' / ', $movie->attribute['cast']);
                }
                echo '<br />';
			}
			if (isset($movie->attribute['pubdate']))
			{
				echo '上映日期: '.$movie->attribute['pubdate'].'<br />';
			}
			if (isset($movie->attribute['aka']))
			{
				echo '又名: '.$movie->attribute['aka'].'<br />';
			}
			$i++;
			?>
			</div>
		</td>
	</tr>
<?php } ?>
</table>

<?php if ($movies->total > 10): ?>
<div id="status">
<?php echo html::anchor(Route::get('search')->uri(array(
	'action' => Request::instance()->action,
	'query'  => $query,
	'index'  => ($index + $max),
	'max'    => $max,
	)), '下 '.$max.' 部电影 »'); ?>
</div>
<?php endif; ?>

<?php else: ?>
<p class="message">
	没有找到你要搜索的图书 :(<br />
	请尝试重新搜索。
</p>
<?php endif; ?>