<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Event extends Controller_Modou_Template {

	private $event = NULL;

	public function before()
	{
		parent::before();

		$this->event = $this->douban->event();
		$this->head->title->set($this->config->title);
	}

	public function action_index($id)
	{
		$this->template->content = View::factory('pages/event/view')
			->bind('event', $event);

		$event = $this->event->get($id);
		$title = $event->title;
		$this->head->title->prepend($title);
	}

	public function action_wishers($id, $index = 1, $max = 10)
	{
		$this->template->content = View::factory('pages/people/list')
			->bind('index', $index)
			->bind('max', $max)
			->bind('peoples', $wishers);

		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');

		$wishers = $this->event->get_wishers($id, $index, $max);
		$title = $wishers->title;
		$this->head->title->prepend($title);
	}

	public function action_wish($id)
	{
		$result = $this->event->wish($id);
		if ($result)
		{
			$this->request->redirect(Route::get('event')->uri(array(
				'id' => $id,
				'action' => '',
				)));
		}
		else
		{
			echo Kohana::debug($this->douban->errors());
		}
	}

	public function action_do($id)
	{
		$result = $this->event->participate($id);
		if ($result)
		{
			$this->request->redirect(Route::get('event')->uri(array(
				'id' => $id,
				'action' => '',
				)));
		}
		else
		{
			echo Kohana::debug($this->douban->errors());
		}
	}

	public function action_cancel($id)
	{
		if ($_GET)
		{
			$status = Arr::get($_GET, 'status');
			switch ($status)
			{
				case 'wish':
					$status = 'wishers';
					break;
				case 'participate':
					$status = 'participants';
					break;
			}

			$result = $this->event->cancel($id, $status);
			if ($result)
			{
				$this->request->redirect(Route::get('event')->uri(array(
					'id' => $id,
					'action' => '',
					)));
			}
			else
			{
				echo Kohana::debug($this->douban->errors());
			}
		}
		else
		{
			echo '没有设置状态';
		}

	}
}