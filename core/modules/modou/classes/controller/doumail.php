<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Doumail extends Controller_Modou_Template {

	private $doumail = NULL;

	public function before()
	{
		parent::before();

		$this->doumail = $this->douban->doumail();
		$this->head->title->set($this->config->title);
	}

    public function action_index()
    {
		$this->template->content = View::factory('pages/doumail/index');
    }

    public function action_unread($index = 1, $max = 10)
    {
        $index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
        $doumails = $this->doumail->get_unread($index, $max);
        $title = $doumails->title;

		$this->template->content = View::factory('pages/doumail/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('doumails', $doumails);

		$this->head->title->prepend($title);
    }

    public function action_inbox($index = 1, $max = 10)
    {
        $index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
        $doumails = $this->doumail->get_inbox($index, $max);
        $title = $doumails->title;

		$this->template->content = View::factory('pages/doumail/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('doumails', $doumails);

		$this->head->title->prepend($title);
    }

    public function action_outbox($index = 1, $max = 10)
    {
        $index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
        $doumails = $this->doumail->get_outbox($index, $max);
        $title = $doumails->title;

		$this->template->content = View::factory('pages/doumail/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('doumails', $doumails);

		$this->head->title->prepend($title);
    }

    public function action_get($doumail_id)
    {
        $doumail = $this->doumail->get($doumail_id);
        $title = '[豆邮] '.$doumail->title;

        $this->template->content = View::factory('pages/doumail/view')
			->bind('doumail', $doumail);

		$this->head->title->prepend($title);
    }

	public function action_write($people_id)
    {
		$people = $this->douban->people()->get($people_id);
		if ($people)
		{
			if ($_POST)
			{
				$result = $this->_validate_doumail($_POST);
				if (is_bool($result) AND $result)
				{
					$result = $this->doumail->send($_POST);
					if (is_array($result))
					{
						$captcha = $result;
					}
					else if ($result)
					{
						$message = '已发送给对方：'.HTML::anchor('people/'.$people->id, $people->name);
					}
					else
					{
						$message = '发送失败，请重试。';
					}
				}
				else
				{
					echo Kohana::debug($result);
				}
			}
			$title = '写信';
		}
		else
		{
			$title = '找不到该用户';
		}

		$this->template->content = View::factory('pages/doumail/write')
			->bind('people', $people)
			->bind('captcha', $captcha)
			->bind('message', $message);
        $this->head->title->prepend($title);
    }

    public function action_reply($doumail_id)
    {
		$doumail = $this->doumail->get($doumail_id);
        if ($_POST)
        {
            $result = $this->_validate_doumail($_POST);
			if (is_bool($result) AND $result)
			{
				$result = $this->doumail->send($_POST);
				if (is_array($result))
				{
					$captcha = $result;
				}
				else if ($result)
				{
					$people = $doumail->author;
					$message = '已发送给对方：'.HTML::anchor('people/'.$people->id, $people->name);
				}
				else
				{
					$message = '发送失败，请重试。';
				}
			}
			else
			{
				echo Kohana::debug($result);
			}
        }
        
        $title = '回信';
        $this->template->content = View::factory('pages/doumail/write')
			->bind('doumail', $doumail)
			->bind('captcha', $captcha)
			->bind('message', $message);
        $this->head->title->prepend($title);
    }

	private function _validate_doumail(Array $data)
	{
		$validate = Validate::factory($data)
			->filter(TRUE, 'trim')
			->rule('people_id', 'not_empty')
			->rule('title', 'not_empty')
			->rule('content', 'not_empty');

		if (isset($data['token_string']))
		{
			$validate->rule('token_string', 'not_empty');
		}

		if ($validate->check())
		{
			return TRUE;
		}
		else
		{
			return $validate->errors();
		}
	}
}

