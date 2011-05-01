<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Console_Music extends Controller_Console {

	private $music = NULL;
	private $result = NULL;

	public function before()
	{
		parent::before();

		$this->auto_render = FALSE;

		if ( ! $_POST)
		{
			die('need POST method to request.');
		}

		$this->music = $this->douban->music();
		$this->music->alt = Arr::get($_POST, 'alt', 'json');
		$this->music->format = FALSE;
	}

	public function action_get($id = NULL)
	{
		if ( empty($id) )
		{
			echo 'no id';
			return;
		}

		$this->result = $this->music->get($id);
	}

	public function action_search($query = NULL, $index = 1, $max = 10)
	{
		if ( empty($query) )
		{
			echo 'no query';
			return;
		}

		$this->result = $this->music->search($query, $index, $max);
	}

	public function after()
	{
		if ( ! empty($this->result))
		{
			parent::render($this->result, $this->music->alt);
		}
	}
}
