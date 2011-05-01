<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Modou_Template {

	public function action_feedback()
	{
		$feedbacks = Sprig::factory('feedback')
			->load(NULL, FALSE);

		$content = '<h1>User Feedbacks</h1>';;
		if ($feedbacks->count() > 0)
		{
			$content .= '<ol>';
			foreach($feedbacks as $feedback)
			{
				$people = $feedback->people->load();
				$content .= '<li>'.HTML::anchor(Route::get('people')->uri(array('id' => $people->douban_id)), $people->username).
					' - '.date('Y-m-d H:i', $feedback->created).
						'<p><strong>Message</strong>: '.$feedback->message.'</p>'.
						'<p><strong>Type</strong>: '.$feedback->type.'</p>'.
						'<p><strong>UserAgent</strong>: '.$feedback->ua.'</p>'.
					'</li>';
			}
			$content .= '</ol>';
		}

		$this->template->content = $content;
	}
}

