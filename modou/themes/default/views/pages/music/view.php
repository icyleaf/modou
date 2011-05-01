<?php 
//echo Kohana::debug($music); 
$rating = Modou::get_rating($music->rating['average']);
$style = ' star_'.($rating * 10);
$attribute = $music->attribute;

if (isset($music->link['collection']))
{
	$collection_url = $music->link['collection'];
	$collection_id = substr($collection_url, strlen('http://api.douban.com/collection/'));
	$collection = $douban->collection()->get($collection_id);
}
?>	
<table id="book" class="subject">
	<tr>
		<td class="subject"><?php echo HTML::image($music->link['image']); ?></td>
		<td>
			<span class="book"><?php echo HTML::anchor($music->link['alternate'], $music->title); ?></span>
			<div class="info">
				<?php echo implode(' / ', $music->author); ?>
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
		'wish' => HTML::anchor($params.'wish', '想听', array('class' => 'sbutton')),
		'listening' => HTML::anchor($params.'listening', '在听', array('class' => 'sbutton')),
		'listened' => HTML::anchor($params.'listened', '听过', array('class' => 'sbutton')),
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
						$status = '我想听这张唱片';
						break;
					case 'listening':
						$status = '我在听这张唱片';
						break;
					case 'listened':
						$status = '我听过这张唱片';
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
		<?php if (isset($attribute['singer'])): ?>
		表演者: <?php echo $attribute['singer']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['discs'])): //TODO: youwenti?>
		唱片数: <?php echo $attribute['discs']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['isrc'])): ?>
		ISRC: <?php echo $attribute['isrc']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['ean'])): ?>
		条型码: <?php echo $attribute['ean']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['pubdate'])): ?>
		发行时间: <?php echo $attribute['pubdate']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['version'])): ?>
		版本特性: <?php echo $attribute['version']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['publisher'])): ?>
		出版者: <?php echo $attribute['publisher']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['media'])): ?>
		介质: <?php echo $attribute['media']; ?><br />
		<?php endif; ?>
	<tr class="separate"><td colspan="2">
			<span class="star<?php echo $style; ?>"><?php echo $music->rating['average'];?></span>
	</td></tr>
	<tr><td colspan="2">
		<span class="title">曲目</span>
		<div class="info"><?php echo TEXT::auto_p($attribute['tracks']); ?></div>
	</td></tr>
	<?php if (isset($music->summary)): ?>
	<tr><td colspan="2">
		<span class="title">简介</span>
		<div class="info"><?php echo TEXT::auto_p($music->summary); ?></div>
	</td></tr>
	<?php endif; ?>
	<tr class="separate"><td colspan="2">
		<?php echo $music->rating['numRaters'];?> 人评论
	</td></tr>
</table>