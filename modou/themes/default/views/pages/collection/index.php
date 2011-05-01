<h1><?php echo HTML::anchor('collection/mine', '我的收藏'); ?></h1>

<p class="navigation">
<?php
	$subjects = array(
		array(
			'title'		=> '图书',
			'id'		=> 'book',
			'status'	=> array(
				'wish'		=> '想读',
				'reading'	=> '在读',
				'read'		=> '读过',
				),
			),
		array(
			'title'		=> '音乐',
			'id'		=> 'music',
			'status'	=> array(
				'wish'		=> '想听',
				'listening'	=> '在听',
				'listened'	=> '听过',
				),
			),
		array(
			'title'		=> '电影',
			'id'		=> 'movie',
			'status'	=> array(
				'wish'		=> '想看',
				'watching'	=> '在看',
				'watched'	=> '看过',
				),
			),
		);
    
    $i = 1;
	foreach ($subjects as $subject)
	{
		$new_subject = array();
        $i = ($i == 10) ? 0 : $i;
        echo '<i>'.$i.'</i>';
		echo HTML::anchor('collection/mine?cat='.$subject['id'], $subject['title']);
		foreach ($subject['status'] as $status => $title)
		{
			$new_subject[] = HTML::anchor('collection/mine?cat='.$subject['id'].'&status='.$status, $title);
		}
		echo ' ('.implode(' | ', $new_subject).')';
        echo '<br />';
        $i++;
	}
?>
</p>