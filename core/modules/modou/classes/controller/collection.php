<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Collection extends Controller_Modou_Template {

	private $collection = NULL;

	public function before()
	{
		parent::before();

		$this->collection = $this->douban->collection();
		$this->head->title->set($this->config->title);
	}
	
	public function action_index()
	{
		$this->template->content = View::factory('pages/collection/index');
	}

	public function action_mine($index = 1, $max = 10)
	{
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$data = array
		(
			'cat'    => Arr::get($_GET, 'cat'),
			'status' => Arr::get($_GET, 'status')
		);
		$collections = $this->collection->get_by_people('me', $index, $max, $data);
		$title = $collections->title;

		$this->template->content = View::factory('pages/collection/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('collections', $collections);

		$this->head->title->prepend($title);
	}
	
	public function action_subject($subject, $index = 1, $max = 10)
	{
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$collections = $this->collection->get_by_people('me', $index, $max, array('cat' => $subject));
		$title = $collections->title;

		$this->template->content = View::factory('pages/collection/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('collections', $collections);

		$this->head->title->prepend($title);
	}

	public function action_create()
	{
		if ($_GET)
		{
			$type = Arr::get($_GET, 'type');
			$id = Arr::get($_GET, 'id');
			$subject_url = 'http://api.douban.com/'.$type.'/subject/'.$id;
			$_GET['subject_url'] = $subject_url;
			unset($_GET['type'], $_GET['id']);
			
			$result = $this->collection->create($_GET);
			if ($result)
			{
				$this->request->redirect(Route::get($type)->uri(array(
					'id' => $id,
					)));
			}
			else
			{
				echo Kohana::debug($this->douban->errors());
			}
		}
	}

	public function action_edit($collection_id)
	{
		
	}

	public function action_delete($collection_id)
	{
		$result = $this->collection->delete($collection_id);
		if ($result)
		{
			$callback_url = Arr::get($_GET, 'subject_url', URL::base(FALSE));
			$this->request->redirect($callback_url);
		}
	}

}

