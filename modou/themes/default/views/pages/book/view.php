<?php 
//echo Kohana::debug($book); 
$rating = Modou::get_rating($book->rating['average']);
$style = ' star_'.($rating * 10);
$attribute = $book->attribute;

if (isset($book->link['collection']))
{
	$collection_url = $book->link['collection'];
	$collection_id = substr($collection_url, strlen('http://api.douban.com/collection/'));
	$collection = $douban->collection()->get($collection_id);
}
?>	
<table id="book" class="subject">
	<tr>
		<td class="subject"><?php echo HTML::image($book->link['image']); ?></td>
		<td>
			<span class="book"><?php echo HTML::anchor($book->link['alternate'], $book->title); ?></span>
			<div class="info">
				<?php echo implode(' / ', $book->author); ?>
			</div>
		</td>
	</tr>
	<tr class="separate"><td colspan="2">
	<?php
	$controller = Request::instance()->controller;
	$id = Request::instance()->param('id');
	$params = 'collection/create?type='.$controller.'&id='.$id.'&status=';
	$current_uri = '?subject_url='.Request::instance()->uri;
	$actions = array
	(
		'wish' => HTML::anchor($params.'wish', '想读', array('class' => 'sbutton')),
		'reading' => HTML::anchor($params.'reading', '在读', array('class' => 'sbutton')),
		'read' => HTML::anchor($params.'read', '读过', array('class' => 'sbutton')),
	);
	if (isset($collection))
	{
		foreach ($actions as $key => $value)
		{
			if ($key == $collection->status)
			{
				switch ($collection->status)
				{
					case 'wish':
						$status = '我想听这本书';
						break;
					case 'reading':
						$status = '我在读这本书';
						break;
					case 'read':
						$status = '我读过这本书';
						break;
				}
				$status .= ' / ';
				$actions['cancel'] = HTML::anchor(URL::site(
					'collection/delete/'.$collection->id.$current_uri),
					'删除',
					array('class' => 'sbutton_del')
				);
				unset($actions[$key]);
				break;
			}
		}
	}
	else
	{
		unset($actions['cancel']);
		$status = '';
	}

	$rating = '';
	if (isset($collection->rating))
	{
		$star = ' star_'.($collection->rating['value'] * 10);
		$rating = '<span class="left">我的评价: </span><span class="star'.$star.'"></span>';
	}

	echo $status.implode(' / ', $actions).'<br />'.$rating;
	?>
	</td></tr>
	<tr><td colspan="2">
		<?php if (isset($attribute['author'])): ?>
		作者: <?php echo $attribute['author']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['translator'])): ?>
		译者: <?php echo $attribute['translator']; ?><br />
		<?php endif; ?>

		<?php if (isset($attribute['isbn13'])): ?>
		ISBN: <?php echo $attribute['isbn13']; ?><br />
		<?php elseif(isset($attribute['isbn10'])): ?>
		ISBN: <?php echo $attribute['isbn10']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['pages'])): ?>
		页数: <?php echo $attribute['pages']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['price'])): ?>
		定价: <?php echo $attribute['price']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['binding'])): ?>
		装帧: <?php echo $attribute['binding']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['pubdate'])): ?>
		出版年: <?php echo $attribute['pubdate']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['subtitle'])): ?>
		副标题: <?php echo $attribute['subtitle']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['publisher'])): ?>
		出版社: <?php echo $attribute['publisher']; ?><br />
		<?php endif; ?>
	</tr>
	<tr class="separate"><td colspan="2">
			<span class="star<?php echo $style; ?>"><?php echo $book->rating['average'];?></span>
	</td></tr>
	<tr><td colspan="2">
		<span class="title">简介</span>
		<div class="info"><?php echo TEXT::auto_p($book->summary); ?></div>
	</td></tr>
	<tr class="separate"><td colspan="2">
		<?php echo $book->rating['numRaters'];?> 人评论
	</td></tr>
	<?php if (isset($book->attribute['author-intro'])): ?>
	<tr><td colspan="2">
		<span class="title">作者简介</span>
		<div class="info"><?php echo TEXT::auto_p($book->attribute['author-intro']); ?></div>
	</td></tr>
	<?php endif; ?>
</table>