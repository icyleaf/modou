<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Feedback extends Controller_Modou_Template {

	public function before()
	{
		parent::before();

		$this->head->title->set($this->config->title);
		$this->head->title->prepend('意见反馈');
	}

	public function action_index()
	{
		if ($_POST)
		{
			$_POST['ua'] = Request::$user_agent;
			$feedback = Sprig::factory('feedback')
				->values($_POST);

			try
			{
				$feedback->create();
				$success = '感谢你的反馈，请继续支持魔豆！';
			}
			catch(Validate_Exception $e)
			{
				$error = '您好像忘记填写问题或意见了。';
			}
		}
		
		$this->template->content = View::factory('pages/feedback')
			->bind('people_id', $people_id)
			->bind('error', $error)
			->bind('success', $success);

		if ($people = $this->douban->get_user())
		{
			$people_id = $people->id;
		}
	}

}

