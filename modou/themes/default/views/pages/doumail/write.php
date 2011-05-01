<h1>书写豆邮</h1>
<?php
	// Post data
	$title = Arr::get($_POST, 'title');
	$content = Arr::get($_POST, 'content');

	if (Request::current()->action == 'reply')
	{
		$title = 'Re: '.$doumail->title;
		$people = $doumail->author;
	}

    $thumb = 'avatar';
    $mobile = Request::user_agent('mobile');
    if ($mobile AND $mobile != 'iPhone')
    {
        $thumb = 'avatar_mobile';
    }
?>
<?php if ( ! isset($message)): ?>
<form method="POST">
<table id="doumail" class="subject">
    <tr>
        <td class="<?php echo $thumb; ?>"><?php echo HTML::image($people->link['icon']); ?></td>
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
                        echo HTML::anchor('people/'.$people->id, $people->name);
                        break;
                    case 'system':
                        echo HTML::image('media/images/system.gif').' 系统豆邮件';
                        break;
                    case 'host':
                        echo HTML::image('media/images/host_small.gif').' ';
                        echo HTML::anchor($people->link['alternate'], $people->name);
                        break;
                }
			?>
			</span><br />
            标题: <?php echo Form::input('title', $title);?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
			<?php echo Form::textarea('content', $content); ?><br />
            <?php if (isset($captcha)): ?>
			<?php echo Form::hidden('captcha_token', $captcha['captcha_token']); ?>
			验证码:<?php echo Form::input('captcha_string'); ?><br />
			<?php echo HTML::image($captcha['captcha_small_url']); ?><br />
			<small>豆瓣因频繁发信会需要验证图片中的单词</small>
			<?php endif; ?>
        </td>
    </tr>
	<tr>
        <td colspan="2">
            <input type="hidden" name="people_id" value="<?php echo $people->id; ?>" />
            <input type="submit" value="发送" />
        </td>
    </tr>
</table>
</form>
<?php else: ?>
<?php echo $message; ?>
<?php endif; ?>