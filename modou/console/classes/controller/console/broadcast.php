<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Console_Broadcast extends Controller_Console {
	
	private $broadcast = NULL;
	private $result = NULL;
	
	public function before()
	{
		parent::before();

		$this->auto_render = FALSE;
		
		if ( ! $_POST)
		{
			die('need POST method to request.');
		}	
			
		$this->broadcast = $this->douban->broadcast();
		$this->broadcast->alt = Arr::get($_POST, 'alt', 'json');
		$this->broadcast->format = FALSE;
	}

	public function action_get($id = NULL)
	{
		if (empty($id))
		{
			echo 'no id';
			return;
		}
		
		$this->result = $this->broadcast->get($id);
	}
	
	public function action_getContacts($id = NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$this->result = $this->broadcast->get_contacts($id, $index, $max);
	}
	
	public function action_getMine($id = NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$this->result = $this->broadcast->get_mine($id, $index, $max);
	}
	
	public function action_post($message = NULL)
	{
		if (empty($message))
		{
			echo 'no string';
			return;
		}
		
		$this->result = $this->broadcast->create($message);
	}
	
	public function after()
	{
		if ( ! empty($this->result))
		{
			parent::render($this->result, $this->broadcast->alt);
		}
	}
}

	