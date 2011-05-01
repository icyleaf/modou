<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Modou extends Controller_Modou_Template {

	public function before()
	{
		if ($this->request->action === 'media')
		{
			// Do not template media files
			$this->auto_render = FALSE;
		}
		else
		{
			parent::before();
		}
	}
	public function action_test()
	{
		$url = 'http://api.douban.com/movie/subjects?q='.urlencode('天使').'&alt=json&apikey=0aed4a7b7cb8daff20c7df72762a90fd';
		$result = Douban_Request::get($url);
		
		$this->_format($result);
		
	}

	private function _format($result)
	{
		$result = $result->to_json();
		echo Kohana::debug($result['opensearch:totalResults']['$t']);
	}

	public function action_index()
	{
		if ($people = $this->douban->get_user())
		{
			$this->template->content = View::factory('pages/home')
				->set('search', View::factory('pages/search/general'))
				->bind('navigations', $navigations);

			$unread = '';
			$mails = $this->douban->doumail()->get_unread();
			if (isset($mails->total) AND $mails->total > 0)
			{
				$unread = '('.$mails->total.')';
			}

			$this->template->content->navigations = array
			(
				array
				(
					'友邻广播' => 'broadcast/contacts',
					'我的收藏' => 'collection',	
					'我的豆邮'.$unread => 'doumail',
					//'我的同城' => 'event/mine',
				),
				array
				(
					//'发布日记' => 'note/create',
					//'创建活动' => 'event/create',
				),
				array
				(
					//'我的推荐' => 'recommendation/mine',
					//'同城活动' => 'event/location',
					//'更多...' => 'people/'.$people->id,
				),
			);
		}
		else
		{
			$this->template->content = View::factory('pages/welcome');
		}
	}

    public function action_nimiety()
    {
        $result = $this->douban->request_token();
        if ($result->status() == 403)
        {
            $this->template->content = '抱歉，目前由于访问者请求次数过多，超出豆瓣每分钟请求限制，请过 30 分钟后重新尝试。 ';
        }
        else
        {
            $this->request->redirect(URL::base());
        }
    }

    public function action_douban_error()
    {
        $result = $this->douban->request_token();
        if ($result->status() == 500)
        {
            $this->template->content = '豆瓣开小车中...';
        }
        else
        {
            $this->request->redirect(URL::base());
        }
    }
	
	/**
	 * Get media file form alpaca module in media directory
	 */
	public function action_media()
	{
		// Generate and check the ETag for this file
		$this->request->check_cache(sha1($this->request->uri));
		
		// Get the file path from the request
		$file = $this->request->param('file');

		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));

		if ($file = Kohana::find_file('media', $file, $ext))
		{
			// Send the file content as the response
			$this->request->response = file_get_contents($file);
		}
		else
		{
			// Return a 404 status
			$this->request->status = 404;
		}

		// Set the content type for this extension
		$this->request->headers['Content-Type'] = File::mime_by_ext($ext);
	}

}

