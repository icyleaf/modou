<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Console_People extends Controller_Console {
	
	private $people = NULL;
	private $result = NULL;
	
	public function before()
	{
		parent::before();

		$this->auto_render = FALSE;

//		if ( ! $_POST)
//		{
//			die('need POST method to request.');
//		}
			
		$this->people = $this->douban->people();
		$this->people->alt = Arr::get($_POST, 'alt', 'json');
		$this->people->format = FALSE;
	}

	public function action_get($id = NULL)
	{
		$id = ($id=='me')?'@me':$id;
		$this->result = $this->people->get($id);
	}
	
	public function action_getFriends($id = NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$this->result = $this->people->get_friends($id, $index, $max);
	}
	
	public function action_getContacts($id = NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$this->result = $this->people->get_contacts($id, $index, $max);
	}
	
	public function action_search($query = NULL, $index = 1, $max = 10)
	{
		if (empty($query))
		{
			echo 'no query';
			return;
		}
		
		$this->result = $this->people->search($query, $index, $max);
	}
	
	public function after()
	{
		if ( ! empty($this->result))
		{
			parent::render($this->result, $this->people->alt);
		}
	}
}

