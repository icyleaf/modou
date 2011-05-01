<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Music extends Controller_Modou_Template {
	
	private $music = NULL;
	
	public function before()
	{
		parent::before();
		
		$this->music = $this->douban->music();	
		$this->head->title->set($this->config->title);
	}
	
	public function action_index($id)
	{
		$this->template->content = View::factory('pages/music/view')
			->bind('music', $music);

		$music = $this->music->get($id);
		//echo Kohana::debug($music);
		$title = $music->title;
		$this->head->title->prepend($title);
	}
	
}

