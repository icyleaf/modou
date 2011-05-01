<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Note extends Controller_Modou_Template {

	private $note = NULL;

	public function before()
	{
		parent::before();

		$this->note = $this->douban->note();
		$this->head->title->set($this->config->title);
	}

	public function action_index($id)
	{
		$this->template->content = View::factory('pages/note/view')
			->bind('note', $note);

		$note = $this->note->get($id);
		$title = $note->title;
		$this->head->title->prepend($title);
	}

}
	