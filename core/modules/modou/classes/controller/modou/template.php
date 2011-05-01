<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Modou_Template extends Controller_Template {
	
	public $douban		= NULL;
	public $head		= NULL;
	public $session		= NULL;
	public $config 		= NULL;
	public $template 	= 'template';
	
	public function before()
	{
		// Load theme
//		if (Request::user_agent('mobile') == 'iPhone' )
//		{
//			$modules = Kohana::modules();
//			$modules['modou_theme'] = DOCROOT.'modou/themes/iphone';
//			Kohana::modules($modules);
//			
//			// Clean up
//			unset($modules);
//		}
		
		// Instance classes
		$this->douban = Douban::instance();
		$this->head = Head::instance();
		$this->session = Session::instance();
		$this->config = Kohana::config('modou');
		
//		$result = $this->douban->request_token();
//		echo Kohana::debug($result);
//
//		if ($result->status() == 403)
//		{
//			if ($this->request->action != 'nimiety' AND $this->request->controller != 'feedback')
//			{
//				$this->request->redirect('nimiety');
//			}
//		}

		// Title
		$this->head->title->set($this->config->title);
		$this->head->title->append($this->config->description);
		// Css
		$this->head->css->append_file('media/css/screen.css', '0.9', 'all');
		$this->head->css->append_file('media/css/layout.css', 'date');
		// Javascript
		$this->head->javascript->append_file('media/js/jquery/jquery-1.4.1.min.js');
		$this->head->javascript->append_file('media/js/modou.js');
		// Links
		$this->head->link->append('favicon.ico', '', 'icon', 'image/x-icon');
		
		// View
		View::bind_global('config', $this->config);
		View::bind_global('douban', $this->douban);

		$this->template = View::factory($this->template)
			->set('head_data', $this->head)
			->bind('menus', $menus);

        if ($this->douban->logged_in())
        {
            if (empty($this->request->uri))
            {
                $menus = array
                (
                    'auth/logout' => '注销用户',
                );
            }
			else
            {
                $menus = array
                (
                    '' => '首页',
                );
            }
        }
	}
    
}


