<h1>豆邮</h1>
<?php
    $actions = array
    (
        HTML::anchor('doumail/reply/'.$doumail->id, '回复', array('class' => 'sbutton')),
        HTML::anchor('doumail/delete/'.$doumail->id, '删除', array('class' => 'sbutton delete')),
    );

    $author = $doumail->author;
    $thumb = 'avatar';
    $mobile = Request::user_agent('mobile');
    if ($mobile AND $mobile != 'iPhone')
    {
        $thumb = 'avatar_mobile';
    }
?>
<div class="separate"><?php echo implode(' | ', $actions); ?></div>
<table id="doumail" class="subject">
    <tr>
		<td class="<?php echo $thumb; ?>"><img class="title" src="<?php echo $author->link['icon']; ?>" /></td>
		<td>
			<span class="collection">
           
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
			echo '<br />时间: '.date('Y-m-d H:i', $doumail->published);
            echo ' ('.Modou::time_ago($doumail->published).')<br />';
			?>
			 </span>
		</td>
	</tr>
    <tr>
        <td colspan="2">话题: <?php echo html::anchor('doumail/'.$doumail->id, $doumail->title); ?></td>
    </tr>
    <tr>
        <td colspan="2"><?php echo Modou::format_html($doumail->content); ?></td>
    </tr>
</table>
<div class="separate"><?php echo implode(' | ', $actions); ?></div>