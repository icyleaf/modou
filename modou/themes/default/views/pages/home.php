<?php 
	$i = 1;
	foreach($navigations as $navigation)
	{
		echo '<p class="navigation">';
		foreach($navigation as $title => $link)
		{
			$i = ($i == 10) ? 0 : $i;
			echo '<i>'.$i.'</i>';
			echo html::anchor($link, $title, array('accesskey' => $i));
			echo '<br /';
			$i++;
		}
		echo '</p>';
	}
?>

<?php echo $search; ?>