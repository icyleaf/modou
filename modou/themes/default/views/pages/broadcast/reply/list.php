<p><?php echo $comments->title; ?></p>
<?php if (count($comments->entry) > 0): ?>
<small>
	第 <?php echo $index.' - '.($index + $max - 1); ?> 条回应
</small>
<table id="comments" class="subject">
<?php
	$i = 0;
	$date_heading = FALSE;
	foreach ($comments->entry as $comment):
		//echo Kohana::debug($comment);
		//echo $comment->category.'<br />';
		$style = ($i%2 == 0) ? 'even' : 'odd';
		$author  = $comment->author;
		$category = isset($comment->category) ? $comment->category : '';
		
		$time = $comment->published;
		if ($time > 0) {
	    	$date = date('Y-m-d', $comment->published);
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
			$date = $comment->published;
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
				// TODO: action anchor
				//if ($comment->category == 'saying'){
					echo HTML::image('media/images/reply.png');
				//	}
				echo HTML::image('media/images/dm.png');
			?>
			</small>
			<small><?php echo Modou::time_ago($comment->published); ?></small>
			<br />
			<span class="message">
				<?php echo Modou::format_url($comment->content, $category); ?>
			</span>
		</td>
	</tr>
			
<?php
	$i++;
	endforeach;
?>
</table>

<?php if ($comments->total > $max): ?>
<div id="status">
<?php
$controller = Request::instance()->controller;
$action = Request::instance()->action;
$id = Request::instance()->param('id');
$next = $index + $max;

echo html::anchor($controller.'/'.$action.'/'.$id.'/'.$next.'/'.$max, '下 '.$max.' 条回应');
?>
</div>
<?php endif ?> 

<?php else: ?>
<div id="status">没有回应</div>
<?php endif; ?>