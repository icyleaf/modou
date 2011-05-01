<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Group extends Controller_Modou_Template {
	
	public function before()
	{
		parent::before();
		
		$this->head->title->set('魔豆小组');
	}
	
	public function action_topic($id)
	{
		$title = '[没有匹配到标题]';
		$date = '';
		$author = '';
		$avatar = '';
		$content = '';
		$url = 'http://www.douban.com/group/topic/'.$id.'/';
		try
		{
			$url_content = Remote::get($url);

			$reg_title = '/<h1>(.+)*<\/h1>/i';
			$reg_date = '/<span class="color-green">(.+)*<\/span>/i';
			$reg_author = '/<span class="pl20">(.+)*<\/span>/i';
			$reg_avatar = '/<img class="pil" src="(.+)" alt/i';
			$reg_content = '/<p>(.*)<\/p>/i';
			
			if (preg_match($reg_title, $url_content, $match))
			{
					$title = $match[1];
					$reg_title_full = '/<td class="tablecc"><strong>(.+)<\/strong>(.+)<\/td><td/i';
					if (preg_match($reg_title_full, $url_content, $match))
					{
							$title = $match[2];
					}

					if ( ! empty($title))
					{
							$this->head->title->prepend($title);
					}
			}

			if (preg_match($reg_date, $url_content, $match))
			{
					$date = $match[1];
			}

			if (preg_match($reg_author, $url_content, $match))
			{
					$author = $match[1];
					$author = str_ireplace('http://www.douban.com/people', URL::site('people'), $author);
			}

			if (preg_match($reg_avatar, $url_content, $match))
			{
					$avatar = $match[1];
			}

			if (preg_match($reg_content, $url_content, $match))
			{
					$content = $match[1];
			}
		}
		catch(Exception $e)
		{
			$title = '找不到该话题';
			$content = '该话题可能已经被删除';
		}

		$this->template->content = View::factory('pages/group/topic')
			->set('error', TRUE)
			->bind('title', $title)
			->bind('author', $author)
			->bind('avatar', $avatar)
			->bind('date', $date)
			->bind('content', $content);
	}
}

