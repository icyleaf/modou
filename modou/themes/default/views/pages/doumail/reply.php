<h1>书写豆邮</h1>
<?php
    $title = 'Re: '.$doumail->title;
    $author = $doumail->author;

    $thumb = 'avatar';
    $mobile = Request::user_agent('mobile');
    if ($mobile AND $mobile != 'iPhone')
    {
        $thumb = 'avatar_mobile';
    }
?>
<form method="POST">
<table id="doumail" class="subject">
    <tr>
        <td class="<?php echo $thumb; ?>"><?php echo HTML::image($author->link['icon']); ?></td>
        <td>
            <span class="collection">
            <?php
                if ( ! $doumail->receiver)
                {
                    echo '寄给: ';
                }
                else
                {
                    echo '来自: ';
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
			?>
			</span><br />
            标题: <input type="text" name="title" value="<?php echo $title; ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea name="content"></textarea><br />
            <input type="hidden" name="people_id" value="<?php echo $author->id; ?>" />
            <input type="submit" value="发送" />
        </td>
    </tr>
</table>
</form>