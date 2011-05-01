<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Broadcast extends Controller_Modou_Template {
	
	private $broadcast = NULL;
	
	public function before()
	{
		parent::before();
		
		$this->broadcast = $this->douban->broadcast();	
		$this->head->title->set($this->config->title);
	}
	
	public function action_index()
	{
		$this->request->redirect('broadcast/contacts');
	}
	
	public function action_mine($index = 1, $max = 10)
	{
		if ( ! $this->douban->logged_in())
		{
			$this->request->redirect('auth/redirect');	
		}
		
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$broadcasts = $this->broadcast->get_mine('me', $index, $max);
		$title = $broadcasts->title;
		
		$write_broadcast = View::factory('pages/broadcast/write');
		$list_broadcasts = View::factory('pages/broadcast/list')
			->set('title', $title)
			->set('index', $index)
			->set('max', $max)
			->set('broadcasts', $broadcasts);
		$this->template->content = $write_broadcast.$list_broadcasts;

		$this->head->title->prepend($title);
	}
	
	
	public function action_contacts($index = 1, $max = 10)
	{
		if ( ! $this->douban->logged_in())
		{
			$this->request->redirect('auth/redirect');	
		}
		
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$broadcasts = $this->broadcast->get_contacts('me', $index, $max);
		$title = $broadcasts->title;

		$write_broadcast = View::factory('pages/broadcast/write');
		$list_broadcasts = View::factory('pages/broadcast/list')
			->set('title', $title)
			->set('index', $index)
			->set('max', $max)
			->set('broadcasts', $broadcasts);
		$this->template->content = $write_broadcast.$list_broadcasts;

		$this->head->title->prepend($title);
	}
	
	public function action_create()
	{
		$status = Arr::get($_POST, 'status');
		if ( ! empty($status))
		{
			$result = $this->broadcast->create($status);
			if ($result)
			{
				$this->request->redirect('broadcast/contacts');	
			}
			else
			{
				echo Kohana::debug($broadcast->error());
			}
		}
		else
		{
			$this->template->content = '内容不能为空！';
		}
	}
	
	public function action_delete($id)
	{
		$result = $this->broadcast->delete($id);
		if ($result)
		{
			$this->request->redirect('broadcast/contacts');	
		}
		else
		{
			$this->template->content = '删除发生错误，请确实此广播是否已经被删除！';
		}
	}
	
	public function action_comments($id, $index = 1, $max = 10)
	{
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$comments = $this->broadcast->get_comments($id, $index, $max);
		
		$title = $comments->title;
		$write_reply = View::factory('pages/broadcast/reply/write')
			->set('miniblog_id', $id)
			->set('comments', $comments); 
		$list_reply = View::factory('pages/broadcast/reply/list')
			->set('index', $index)
			->set('max', $max)
			->set('comments', $comments);
		$this->template->content = $write_reply.$list_reply;

		$this->head->title->prepend($title);
	}
	
	public function action_reply()
	{
		if ($_POST)
		{
			$miniblog_id = Arr::get($_POST, 'miniblog_id');
			$message = Arr::get($_POST, 'message');
			
			$result = $this->broadcast->reply($miniblog_id, $message);
			
			if ($result)
			{
				$this->request->redirect('broadcast/comments/'.$miniblog_id);	
			}
			else
			{
				$this->template->content = '回应发生错误，请重试。';
			}
		}
	}
		
	public function action_people($id, $index = 1, $max = 10)
	{
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$broadcasts = $this->broadcast->get_contacts($id, $index, $max);
		echo Kohana::debug($broadcasts);
		die();
		
		$title = $broadcasts->title;
		
		$write_broadcast = View::factory('pages/broadcast/write');
		$list_broadcasts = View::factory('pages/broadcast/list')
			->set('title', $title)
			->set('index', $index)
			->set('max', $max)
			->set('broadcasts', $broadcasts);
		$this->template->content = $write_broadcast.$list_broadcasts;

		$this->head->title->prepend($title);
	}
	
}

