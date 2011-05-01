<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Console_Doumail extends Controller_Console {
	
	private $doumail = NULL;
	private $result = NULL;

	public function before()
	{
		parent::before();

		$this->auto_render = FALSE;

		if ( ! $_POST)
		{
			die('need POST method to request.');
		}

		$this->doumail = $this->douban->doumail();
		$this->doumail->alt = Arr::get($_POST, 'alt', 'json');
		$this->doumail->format = FALSE;
	}

	public function action_get($id = NULL)
	{
		if ( empty($id) )
		{
			echo 'no id';
			return;
		}
		
		$this->result = $this->doumail->get($id);
	}
	
	public function action_getInbox($index = 1, $max = 10)
	{
		$this->result = $this->doumail->get_inbox($index, $max);
	}
	
	public function action_getUnread($index = 1, $max = 10)
	{
		$this->result = $this->doumail->get_unread($index, $max);
	}

	public function action_getOutbox($index = 1, $max = 10)
	{
		$this->result = $this->doumail->get_outbox($index, $max);
	}
	
	public function action_send($id = NULL, $title = NULL, $content = NULL, $captcha_token = NULL, $captcha_string = NULL)
	{
		if (empty($id) OR empty($title) OR empty($content))
		{
			echo 'missing id or title or content';
			return;
		}
		
		$this->result = $this->doumail->post($id, $title, $content, $captcha_token, $captcha_string);
	}
	
	public function after()
	{
		if ( ! empty($this->result))
		{
			parent::render($this->result, $this->doumail->alt);
		}
	}

}

	