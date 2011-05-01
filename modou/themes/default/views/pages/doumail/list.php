<h1><?php echo $doumails->title; ?></h1>

<?php
$flag = isset($doumails->total) ? FALSE : TRUE;
$count = isset($doumails->total) ? $doumails->total : count($doumails->entry);
if ($count > 0): ?>
<small>
	<?php 
        echo $index.' - '.($index + $max - 1);
        if (isset($doumails->total))
        {
            echo ' (共有 '.$doumails->total.' 封豆邮)';
        }
        else
        {
           echo ' 封豆邮';
        }
     ?>
</small>
<table id="doumail" class="subject">
<?php
	$i = 0;
	foreach ($doumails->entry as $doumail)
	{
        //echo Kohana::debug($doumail);
		$style = ($i%2 == 0) ? 'even' : 'odd';
        $author = $doumail->author;
        $thumb = 'avatar';
        $mobile = Request::user_agent('mobile');
        if ($mobile AND $mobile != 'iPhone')
        {
            $thumb = 'avatar_mobile';
        }
?>
	<tr class="<?php echo $style; ?>">
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $author->link['icon']; ?>" /></td>
		<td>
			<span class="collection">
            <?php
                if (isset($doumail->attribute) AND $doumail->attribute['unread'])
                {
                    echo '[未读] ';
                }
                echo html::anchor('doumail/'.$doumail->id, $doumail->title);
            ?>
            </span>
			<div class="info">
			<?php
            if ( ! $doumail->receiver)
            {
                echo '来自: ';
            }
            else
            {
                echo '送往: ';
            }
            switch ($doumail->type)
            {
                default:
                case 'normal':
                    echo HTML::anchor('people/'.$author->id, $author->name);
                    break;
                case 'system':
                    echo HTML::image('media/images/system.gif').' 系统豆邮件';
                    break;
                case 'host':
                    echo HTML::image('media/images/host_small.gif').' ';
                    echo HTML::anchor($author->link['alternate'], $author->name);
                    break;
            }
			echo '<br />'.date('Y-m-d H:i:s', $doumail->published);
            echo ' ('.Modou::time_ago($doumail->published).')<br />';

			$i++;
			?>
			</div>
		</td>
	</tr>
<?php } ?>
</table>

<?php if ((isset($doumails->total) AND $count > 10) OR $flag): ?>
<div id="status">
<?php
$controller = Request::instance()->controller;
$action = Request::instance()->action;
$next = $index + $max;
$uri = $controller.'/'.$action.'/'.$next.'/'.$max.'?'.http_build_query($_GET, '&');

echo html::anchor($uri, '下 '.$max.' 封豆邮 »'); ?>
</div>
<?php endif; ?>

<?php else: ?>
<p class="message">
	没有任何豆邮。
</p>
<?php endif; ?>