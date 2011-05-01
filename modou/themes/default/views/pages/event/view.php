<?php
//echo Kohana::debug($event);
$author = $event->author;

switch ($event->category)
{
	case 'music':
		$category = '音乐/演出';
		break;
	case 'exhibition':
		$category = '展览';
		break;
	case 'film':
		$category = '电影';
		break;
	case 'salon':
		$category = '沙龙';
		break;
	case 'drama':
		$category = '戏曲/曲艺';
		break;
	case 'sports':
		$category = '体育';
		break;
	case 'party':
		$category = '生活/聚会';
		break;
	case 'travel':
		$category = '旅行';
		break;
	case 'commonweal':
		$category = '公益';
		break;
	default:
	case 'others':
		$category = '其他';
		break;
}

$status = isset($event->attribute['status']) ? $event->attribute['status'] : NULL;
$action = array
(
	'wish' => HTML::anchor('event/'.$event->id.'/wish', '感兴趣', array('class' => 'sbutton')),
	'participate' => HTML::anchor('event/'.$event->id.'/do', '参加', array('class' => 'sbutton')),
	'cancel' => HTML::anchor('event/'.$event->id.'/cancel?status='.$status, '取消', array('class' => 'sbutton_del')),
);

if ( ! empty($status))
{
	foreach ($action as $key => $value)
	{
		if ($key == $status)
		{
			switch ($status)
			{
				case 'wish':
					$status = '我对这个活动感兴趣';
					break;
				case 'participate':
					$status = '我会参加这个活动';
					break;
			}

			unset($action[$key]);
			break;
		}
	}
}
else
{
	unset($action['cancel']);
}

?>
<h1><?php echo HTML::anchor($event->link['alternate'], $event->title); ?></h1>
<table id="event" class="subject">
	<tr>
		<td class="subject" colspan="2"><?php echo HTML::image($event->link['image']); ?></td>
	</tr>
	<tr class="separate"><td colspan="2">
		<?php
		if($status)
		{
			echo $status.' / ';
		}

		echo implode(' / ', $action); ?>
	</td></tr>
	<tr><td colspan="2">
		开始时间: <?php echo date('Y年m月d日 H:i', $event->date['start']); ?><br />
		结束时间: <?php echo date('Y年m月d日 H:i', $event->date['end']); ?><br />
		地点: <?php echo $event->address; ?><br />
		发起人: <?php
		switch ($author->type)
		{
			default:
			case 'people':
				echo HTML::anchor(Route::get('people')->uri(array('id' => $author->id)), $author->name);
				break;
			case 'host':
				echo HTML::image('media/images/host_small.gif').' ';
				echo HTML::anchor($author->link['alternate'], $author->name);
				break;
		}
		?><br />
		类型: <?php echo $category; ?><br />
	</tr>
	<tr class="separate"><td colspan="2">
		<?php echo HTML::anchor(Request::instance()->uri.'/wishers', $event->attribute['wishers'].'人感兴趣'); ?> /
		<?php echo HTML::anchor(Request::instance()->uri.'/participants', $event->attribute['participants'].'人参加'); ?>
	</td></tr>
	<tr><td colspan="2">
		<span class="title">活动介绍</span>
		<div class="info"><?php echo TEXT::auto_p($event->summary); ?></div>
	</td></tr>
	<?php if (isset($event->geo)): ?>
	<tr class="separate"><td colspan="2">
	<?php
		$link = 'http://www.google.com/m/maps?ll='.$event->geo['lat'].','.$event->geo['lon'];
		echo HTML::anchor($link, '查看活动地图');
	?>
	</td></tr>
	<?php endif; ?>
	<?php if (isset($event->attribute['author-intro'])): ?>
	<tr><td colspan="2">
		<span class="title">作者简介</span>
		<div class="info"><?php echo TEXT::auto_p($event->attribute['author-intro']); ?></div>
	</td></tr>
	<?php endif; ?>
</table>