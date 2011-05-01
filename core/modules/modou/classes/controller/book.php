<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Book extends Controller_Modou_Template {
	
	private $book = NULL;
	
	public function before()
	{
		parent::before();
		
		$this->book = $this->douban->book();	
		$this->head->title->set($this->config->title);
	}
	
	public function action_index($id)
	{
		$this->template->content = View::factory('pages/book/view')
			->bind('book', $book);

		$book = $this->book->get($id);
		//echo Kohana::debug($book);
		$title = $book->title;
		$this->head->title->prepend($title);
	}
	
}

