<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Modou_Template {
	
	public function before()
	{
		parent::before();
		
		$this->head->title->set('魔豆搜索');
	}
	
	public function action_index()
	{
		if ( isset($_POST['type']) )
		{
			switch($_POST['type'])
			{
				default:
				case '同城活动':
					$type = 'event';
					break;
				case '用户':
					$type = 'people';
					break;
				case '图书':
					$type = 'book';
					break;
				case '电影':
					$type = 'movie';
					break;
				case '音乐':
					$type = 'music';
					break;
			}
            $url = Route::get('search')->uri(array(
                'action' => $type,
                'query'  => $_POST['q']
                ));
			$this->request->redirect($url);
		}
		else
		{
			$this->template->content = new View('pages/search/general');
		}
	}
	
	public function action_book($query = NULL, $index = 1, $max = 10)
	{
		$title ='图书搜索';
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$this->_search($this->request->action, $title, $query, $index, $max);
	}
	
	public function action_movie($query = NULL, $index = 1, $max = 10)
	{
		$title ='电影搜索';
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$this->_search($this->request->action, $title, $query, $index, $max);
	}
	
	public function action_music($query = NULL, $index = 1, $max = 10)
	{
		$title ='音乐搜索';
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$this->_search($this->request->action, $title, $query, $index, $max);
	}
	
	public function action_people($query = NULL, $index = 1, $max = 10)
	{
		$title ='用户搜索';
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$this->_search($this->request->action, $title, $query, $index, $max);
	}
	
	public function action_event($query = NULL, $index = 1, $max = 10)
	{
		$title ='同城搜索';
		$index = ($this->request->param('index') == 0) ? $index : $this->request->param('index');
		$max = ($this->request->param('max') == 0) ? $max : $this->request->param('max');
		$this->_search($this->request->action, $title, $query, $index, $max);
	}
	
	private function _search($type, $title, $query, $index = 1, $max = 10)
	{
		$this->template->content = View::factory('pages/search/general')
			->bind('title', $title)
            ->bind('query', $query)
			->bind('loading_result', $loading_result);

		if (isset($_POST['q']) AND ! empty($_POST['q']))
		{
            $url = Route::get('search')->uri(array(
                'action' => $type,
                'query'  => $_POST['q']
                ));
            $this->request->redirect($url);
		}

		if ( ! empty($query))
		{
			$loading_result = View::factory('pages/'.$type.'/list')
				->bind('query', $query)
				->bind('index', $index)
				->bind('max', $max)
				->bind($type.'s', $result);
				
			if ($type == 'event')
			{
				$result = $this->douban->$type()->search($query, 'all', $index, $max);
			}
			else
			{
				$result = $this->douban->$type()->search($query, $index, $max);
			}
			$this->head->title->set($title);
			$title = $result->title;
			$this->head->title->prepend($title);
		}
		else
		{
			$this->head->title->prepend($title);
		} 
	}

}

