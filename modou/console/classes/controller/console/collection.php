<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Console_Collection extends Controller_Console {
	
	private $collection = NULL;
	private $result = NULL;

	public function before()
	{
		parent::before();

		$this->auto_render = FALSE;

//		if ( ! $_POST)
//		{
//			die('need POST method to request.');
//		}

		$this->collection = $this->douban->collection();
		$this->collection->alt = Arr::get($_POST, 'alt', 'json');
		$this->collection->format = FALSE;
	}

	public function action_getByPeople($id =NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$this->result = $this->collection->get_by_people($id, $index, $max);
	}

	public function action_getBookByPeople($id =NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$data = array
		(
			'cat' 		 	=> 'book',
		);
		$this->result = $this->collection->get_by_people($id, $index, $max, $data);
	}

	public function action_getMusicByPeople($id =NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$data = array
		(
			'cat' 		 	=> 'music',
		);
		$this->result = $this->collection->get_by_people($id, $index, $max, $data);
	}

	public function action_getMovieByPeople($id =NULL, $index = 1, $max = 10)
	{
		$id = empty($id) ? 'me' : $id;
		$data = array
		(
			'cat' 		 	=> 'movie',
		);
		$this->result = $this->collection->get_by_people($id, $index, $max, $data);
	}

	public function after()
	{
		if ( ! empty($this->result))
		{
			parent::render($this->result, $this->collection->alt);
		}
	}

}

