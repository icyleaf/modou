<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Movie extends Controller_Modou_Template {
	
	private $movie = NULL;
	
	public function before()
	{
		parent::before();
		
		$this->movie = $this->douban->movie();	
		$this->head->title->set($this->config->title);
	}
	
	public function action_index($id)
	{
		$this->template->content = View::factory('pages/movie/view')
			->bind('movie', $movie);

		$movie = $this->movie->get($id);
		//echo Kohana::debug($movie);
		$title = $movie->title;
		$this->head->title->prepend($title);
	}
	
}

