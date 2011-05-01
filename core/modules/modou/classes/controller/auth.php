<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Modou_Template {
	
	public function before()
	{
		parent::before();
		
		$this->auto_render = FALSE;
	}
	
	public function action_redirect()
	{
		$callback_url = URL::site('auth/check');
		$auth_url = $request_token = $this->douban->verify($callback_url);
		
		$this->request->redirect($auth_url);
	}
	
	public function action_check()
	{
		if ($this->douban->login())
		{
			$this->_complate_login();

			$this->request->redirect(URL::base(FALSE));
		}
		else
		{
			$this->template->content = 'OAuth 验证失败，'.HTML::anchor('auth/redirect', '重试');
		}
	}
	
	public function action_logout()
	{
		$this->douban->logout();
		
		$this->request->redirect(URL::base(FALSE));
	}

	private function _complate_login()
	{
		$auth_user = $this->douban->get_user();
		$people = Sprig::factory('people', array('douban_id' => $auth_user->id))
			->load();

		$people->location = $auth_user->location['title'];
		if (isset($auth_user->link['homepage']))
		{
			$people->homepage = $auth_user->link['homepage'];
		}
		$people->logins += 1;
		if($people->loaded())
		{
			$people->update();
		}
		else
		{
			$people->create();
		}

		$this->_store_ua($people->id);
	}

	private function _store_ua($people_id)
	{
		$ua = Sprig::factory('user_agent');
		$ua->people_id = $people_id;
		$ua->browser = Request::user_agent('browser');
		$ua->version = Request::user_agent('version');

		$mobile = Request::user_agent('mobile');
		if ( ! empty($mobile))
		{
			$ua->platform = $mobile;
			$ua->is_mobile = 1;
		}
		else
		{
			$ua->platform = Request::user_agent('platform');
			$ua->is_mobile = 0;
		}
		$ua->ua = Request::$user_agent;
		$ua->date = time();
		$ua->create();
	}
}

