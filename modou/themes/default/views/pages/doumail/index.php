<h1>我的豆邮</h1>

<p class="navigation">
<?php
    $navigations = array
    (
		'doumail/unread' => '未读箱',
        'doumail/inbox' => '收件箱',
        'doumail/outbox' => '发件箱',
    );
	$i = 1;
    foreach($navigations as $link => $title)
    {
        $i = ($i == 10) ? 0 : $i;
        echo '<i>'.$i.'</i>';
        echo html::anchor($link, $title, array('accesskey' => $i));
        echo '<br />';
        $i++;
	}
?>
</p>