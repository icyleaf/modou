<h1><?php echo $broadcasts->title; ?></h1>
<?php if (count($broadcasts->entry) > 0): ?>
<small>
	第 <?php echo $index.' - '.($index + $max - 1); ?> 条广播
</small>
<table id="broadcasts" class="subject">
<?php
	$i = 0;
	$date_heading = FALSE;
	foreach ($broadcasts->entry as $broadcast):
//		echo Kohana::debug($broadcast);
//		echo $broadcast->category.'<br />';
		$style = ($i%2 == 0) ? 'even' : 'odd';
		$author  = isset($broadcast->author) ? $broadcast->author : $douban->get_user();
		$category = isset($broadcast->category) ? $broadcast->category : '';
		
		$time = $broadcast->published;
		if ($time > 0) {
	    	$date = date('Y-m-d', $broadcast->published);
			if ($date_heading !== $date) {
				$date_heading = $date;
?>
	<tr style="background: #FFE8DE; color: #555555;font-size: 0.8em">
		<td colspan="2">
			<?php echo date('Y年m月d日 ', $time).Modou::format_week($time); ?>
		</td>
	</tr>
<?php
			}
	    }
		else
		{
			$date = $broadcast->published;
	    }

        $thumb = 'avatar';
        $mobile = Request::user_agent('mobile');
        if ($mobile AND $mobile != 'iPhone')
        {
            $thumb = 'avatar_mobile';
        }
?>	
	<tr class="<?php echo $style; ?>">
		<td class="<?php echo $thumb; ?>"><?php echo HTML::image($author->link['icon']); ?></td>
		<td>
			<span class="people">
				<?php echo HTML::anchor('people/'.$author->id, $author->name); ?>
			</span>
			<small class="bbutton">
			<?php
				if (isset($broadcast->category) AND $broadcast->category == 'saying'){
					echo HTML::anchor('broadcast/comments/'.$broadcast->id, HTML::image('media/images/reply.png'));
				}
				echo HTML::anchor('doumail/write/'.$author->id, HTML::image('media/images/dm.png'));
				
				if ($user = $douban->get_user() AND $user->name == $author->name)
				{
					$uri = 'broadcast/delete/'.$broadcast->id;
					$image = HTML::image('media/images/delete.gif');
					echo HTML::anchor($uri, $image, array('class' => 'delete')); 
				}
			?>
			</small>
			<small><?php echo Modou::time_ago($broadcast->published); ?></small>
			<br />
			<span class="message">
				<?php echo Modou::format_url($broadcast->content, $category); ?>
				<?php 
					if (isset($broadcast->category) AND $broadcast->category == 'saying' AND ($ccount = $broadcast->attribute['comments_count']) > 0)
					{
						echo '('.HTML::anchor('broadcast/comments/'.$broadcast->id, $ccount.'回应').')';
					}
				?>
			</span>
		</td>
	</tr>
			
<?php
	$i++;
	endforeach;
?>
</table>

<div id="status">
<?php
$controller = Request::instance()->controller;
$action = Request::instance()->action;
$next = $index + $max;

echo html::anchor($controller.'/'.$action.'/'.$next.'/'.$max, '下 '.$max.' 条广播');
?>
</div>

<?php else: ?>
<div id="status">找不到广播消息了</div>
<?php endif; ?>