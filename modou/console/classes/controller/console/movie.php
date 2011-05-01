<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Console_Movie extends Controller_Console {

	private $movie = NULL;
	private $result = NULL;

	public function before()
	{
		parent::before();

		$this->auto_render = FALSE;

		if ( ! $_POST)
		{
			die('need POST method to request.');
		}

		$this->movie = $this->douban->movie();
		$this->movie->alt = Arr::get($_POST, 'alt', 'json');
		$this->movie->format = FALSE;
	}

	public function action_get($id = NULL)
	{
		if ( empty($id) )
		{
			echo 'no id';
			return;
		}

		$this->result = $this->movie->get($id);
	}

	public function action_search($query = NULL, $index = 1, $max = 10)
	{
		if ( empty($query) )
		{
			echo 'no query';
			return;
		}

		$this->result = $this->movie->search($query, $index, $max);
	}

	public function after()
	{
		if ( ! empty($this->result))
		{
			parent::render($this->result, $this->movie->alt);
		}
	}
}
