<h1><?php echo $collections->title; ?></h1>

<p>
<?php
	$status = array
	(
		'book' => array(
			'wish'		=> '想读',
			'reading'	=> '在读',
			'read'		=> '读过',
			),
		'music' => array(
			'wish'		=> '想听',
			'listening'	=> '在听',
			'listened'	=> '听过',
			),
		'movie' => array(
			'wish'		=> '想看',
			'watching'	=> '在看',
			'watched'	=> '看过',
			),
	);
	$uri = Request::instance()->uri;
	$cat = Arr::get($_GET, 'cat');
	if (array_key_exists($cat, $status))
	{
		$subject = array();
		foreach ($status[$cat] as $status => $title)
		{
			$subject[] = HTML::anchor($uri.'?cat='.$cat.'&status='.$status, $title);
		}
		echo implode(' | ', $subject);
	}
	else
	{
		
		$items = array
		(
			HTML::anchor($uri.'?cat=book', '图书'),
			HTML::anchor($uri.'?cat=movie', '电影'),
			HTML::anchor($uri.'?cat=music', '音乐'),
		);		
		
		echo implode(' | ', $items);
	}
?>
</p>

<?php if ($collections->total > 0): ?>
<small>
	<?php echo $index.' - '.($index + $max - 1).' (共有 '.$collections->total.' 个收藏)'; ?>
</small>
<table id="collection" class="subject">
<?php 
	$i = 0;
	foreach ($collections->entry as $collection)
	{
//        echo Kohana::debug($collection);
		$style = ($i%2 == 0) ? 'even' : 'odd';
        $subject = $collection->subject;
        $category = $subject->category;

        $thumb = 'subject';
        $mobile = Request::user_agent('mobile');
        if ($mobile AND $mobile != 'iPhone')
        {
            $thumb = 'subject_mobile';
        }
?>
	<tr class="<?php echo $style; ?>">
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $subject->link['image']; ?>" /></td>
		<td>
			<span class="collection"><?php echo html::anchor($category.'/'.$subject->id, $collection->title); ?></span>
			<div class="info">
			<?php
			if (isset($collection->updated))
			{
				echo date('Y-m-d H:i:s', $collection->updated);
                echo ' ('.Modou::time_ago($collection->updated).')<br />';
			}		
			
			$i++;
			?>
			</div>
		</td>
	</tr>
<?php } ?>
</table>

<?php if ($collections->total > 10): ?>
<div id="status">
<?php
$controller = Request::instance()->controller;
$action = Request::instance()->action;
$next = $index + $max;
$uri = $controller.'/'.$action.'/'.$next.'/'.$max.'?'.http_build_query($_GET, '&');

echo html::anchor($uri, '下 '.$max.' 个收藏 »'); ?>
</div>
<?php endif; ?>

<?php else: ?>
<p class="message">
	没有找到你的收藏
</p>
<?php endif; ?>