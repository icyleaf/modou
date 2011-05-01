<?php defined('SYSPATH') or die('No direct script access.');

class Controller_People extends Controller_Modou_Template {
	
	private $people = NULL;
	
	public function before()
	{
		parent::before();
		
		$this->people = $this->douban->people();	
		$this->head->title->set($this->config->title);
	}
	
	public function action_index($id)
	{
		$this->template->content = View::factory('pages/people/view')
			->bind('people', $people);
		
		$people = $this->people->get($id);
		$title = $people->name;
		$this->head->title->prepend($title);
	}
	
	public function action_friends($id, $index = 1, $max = 10)
	{
		$this->template->content = View::factory('pages/people/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('peoples', $peoples);
		
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		
		$peoples = $this->people->get_friends($id, $index, $max);
		$title = $peoples->title;
		$this->head->title->prepend($title);
	}
	
	public function action_contacts($id)
	{
		$this->template->content = View::factory('pages/people/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('peoples', $peoples);
		
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		
		$peoples = $this->people->get_contacts($id, $index, $max);
		$title = $peoples->title;
		$this->head->title->prepend($title);
	}
	
}

