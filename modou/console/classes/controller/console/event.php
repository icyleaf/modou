<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Console_Event extends Controller_Console {

	private $event = NULL;
	private $result = NULL;

	public function before()
	{
		parent::before();

		$this->auto_render = FALSE;

//		if ( ! $_POST)
//		{
//			die('need POST method to request.');
//		}

		$this->event = $this->douban->event();
		$this->event->alt = Arr::get($_POST, 'alt', 'json');
		$this->event->format = FALSE;
	}

	public function action_get($id = NULL)
	{
		if (empty($id))
		{
			echo 'no event id';
			return;
		}
		
		$this->result = $this->event->get($id);
	}
	
	public function action_getByPeople($id = NULL, $index = 1, $max = 10)
	{
		$id = (empty($id) AND $id='me') ? '@me' : $id;
		$this->result = $this->event->get_by_people($id, $index, $max);
	}
	
	public function action_getByLocation($location = NULL, $index = 1, $max = 10, $type = 'all')
	{
		if (empty($location))
		{
			echo 'no city';
			return;
		}
		
		$this->result = $this->event->get_by_location($location, $index, $max, $type);
	}
	
	public function action_getParticipants($id = NULL, $index = 1, $max = 10)
	{
		if (empty($id))
		{
			echo 'no event id';
			return;
		}
		
		$this->result = $this->event->get_participants($id, $index, $max);
	}
	
	public function action_getWishers($id = NULL, $index = 1, $max = 10)
	{
		if (empty($id))
		{
			echo 'no event id';
			return;
		}
		
		$this->result = $this->event->get_wishers($id, $index, $max);
	}
	
	public function action_participate($id = NULL)
	{
		if ( empty($id) )
		{
			echo 'no event id';
			return;
		}
		
		$this->result = $this->event->participate($id);
	}
	
	public function action_wisher($id = NULL)
	{
		if ( empty($id) )
		{
			echo 'no id';
			return;
		}
		
		$this->result = $this->event->wisher($id);
	}
	
	public function action_search($query = NULL, $index = 1, $max = 10)
	{
		if (empty($query))
		{
			echo 'no query';
			return;
		}
		
		$this->result = $this->event->search($query, 'all', $index, $max);
	}
	
	public function after()
	{
		if ( ! empty($this->result))
		{
			parent::render($this->result, $this->event->alt);
		}
	}
}

