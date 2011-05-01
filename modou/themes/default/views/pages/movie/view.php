<?php 
$rating = Modou::get_rating($movie->rating['average']);
$style = ' star_'.($rating * 10);
$attribute = $movie->attribute;

if (isset($movie->link['collection']))
{
	$collection_url = $movie->link['collection'];
	$collection_id = substr($collection_url, strlen('http://api.douban.com/collection/'));
	$collection = $douban->collection()->get($collection_id);

}
?>	
<table id="book" class="subject">
	<tr>
		<td class="subject"><?php echo HTML::image($movie->link['image']); ?></td>
		<td>
			<span class="book"><?php echo HTML::anchor($movie->link['alternate'], $movie->title); ?></span>
			<?php if (isset($movie->author)) : ?>
			<div class="info"><?php echo implode(' / ', $movie->author); ?></div>
			<?php endif; ?>
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
		'wish' => HTML::anchor($params.'wish', '想看', array('class' => 'sbutton')),
		'watching' => HTML::anchor($params.'watching', '在看', array('class' => 'sbutton')),
		'watched' => HTML::anchor($params.'watched', '看过', array('class' => 'sbutton')),
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
						$status = '我想看这部电影/电视剧';
						break;
					case 'watching':
						$status = '我在看这部电影/电视剧';
						break;
					case 'watched':
						$status = '我看过这部电影/电视剧';
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
		<?php if (isset($attribute['director'])): ?>
		导演: <?php echo $attribute['director']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['writer'])): ?>
		<?php $writer = (is_array($attribute['writer'])) ? implode(' / ', $attribute['writer']) : $attribute['writer']; ?>
		编剧: <?php echo $writer; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['cast'])): ?>
		演员: <?php echo implode(' / ', $attribute['cast']); ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['country'])): ?>
		<?php $country = (is_array($attribute['country'])) ? implode(' / ', $attribute['country']) : $attribute['country']; ?>
		国家: <?php echo $country; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['language'])): ?>
		<?php $language = (is_array($attribute['language'])) ? implode(' / ', $attribute['language']) : $attribute['language']; ?>
		语言: <?php echo $language; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['imdb'])): ?>
		IMDB: <?php echo $attribute['imdb']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['pubdate'])): ?>
		上映日期: <?php echo $attribute['pubdate']; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['aka'])): ?>
		<?php $aka = (is_array($attribute['aka'])) ? $attribute['aka'][0] : $attribute['aka']; ?>
		又名: <?php echo $aka; ?><br />
		<?php endif; ?>
		
		<?php if (isset($attribute['website'])): ?>
		官方网站: <?php echo TEXT::auto_link($attribute['website']); ?><br />
		<?php endif; ?>
	</tr>
	<tr class="separate"><td colspan="2">
		<span class="star<?php echo $style; ?>"><?php echo $movie->rating['average'];?></span>
	</td></tr>
	<tr><td colspan="2">
		<span class="title">简介</span>
		<div class="info"><?php echo TEXT::auto_p($movie->summary); ?></div>
	</td></tr>
	<tr class="separate"><td colspan="2">
		<?php echo $movie->rating['numRaters'];?> 人评论
	</td></tr>
</table>