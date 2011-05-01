<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Modou Helper
 *
 * @package modou
 * @author icyleaf
 */
class Modou {
	
	public static function format_html($string, $auto_link = TRUE)
	{
		if ( $auto_link )
		{
			$match = '/[a-zA-z]+:\/\/[^\s]*/';
			$replace = '<a href="$0" target="_blank">$0</a>';
			$string = preg_replace($match, $replace, $string);
		}
		
		return Text::auto_p($string);
	}
	
	public static function format_url($url, $param = NULL)
	{
		$url = str_ireplace('http://www.douban.com/people', URL::site('people'), $url);
		$url = str_ireplace('http://www.douban.com/note', URL::site('note'), $url);
		$url = preg_replace('/http:\/\/www.douban.com\/event\/(\d+)/', URL::site('event/$1'), $url);
		$url = preg_replace('/http:\/\/www.douban.com\/group\/topic\/(\d+)/', URL::site('group/topic/$1'), $url);
		//$url = preg_replace('/http:\/\/www.douban.com\/event\/photo\/(\d+)/', URL::base().'event/photo/$1', $url);
		//$url = preg_replace('/http:\/\/www.douban.com\/photos\/photo\/(\d+)/', URL::base().'photos/photo/$1', $url);
		if (strpos($url, '/subject/') !== FALSE AND ! empty($param))
		{
			$url = preg_replace('/http:\/\/'.$param.'.douban.com\/subject\/(\w+)(\/*)/', URL::site($param.'/$1$2'), $url);
		}
		
		//$url = preg_replace('/@([\x{2E80}-\x{9FFF}]+)\s+/u', '@<a href="#">$1 </a>', $url);
		
		return $url;
	}
	
	public static function format_week($time = NULL)
	{
		$time = empty($time) ? time() : $time;
		$week = date('N', $time);
		switch ($week)
		{
			case 1:
				$week = '一';
				break;
			case 2:
				$week = '二';
				break;
			case 3:
				$week = '三';
				break;
			case 4:
				$week = '四';
				break;
			case 5:
				$week = '五';
				break;
			case 6:
				$week = '六';
				break;
			case 7:
				$week = '日';
				break;
		}
			
		return '星期'.$week;
	}
	
	/**
	 * Convert Seconds to time ago mode
	 *
	 * @param int $date 
	 * @return string
	 */
	public static function time_ago($date)
	{
		if (empty($date))
		{
			return '[X]'.__('前');
		}
		
		$ago = date('U') - $date;
		$periods = array(__('秒'), __('分钟'), __('小时'), __('天'), __('周'), __('月'), __('年'), __('十年'));
		$lengths = array('60', '60', '24', '7', '4.35', '12', '10');
		for ($j = 0; $ago >= $lengths[$j]; $j++)
		{
			$ago /= $lengths[$j];
		}
		$ago = round($ago);
		
		if ($ago != 1) 
		{
			$periods[$j].= __('');
		}
		$output = $ago.' '.$periods[$j].__('前');
		
		return $output;
	}
	
	public static function get_rating($rating)
	{
		switch($rating)
		{
			default:
			case ($rating < 1):
				$rating = 0;
				break;
			case ($rating < 2 && $rating >= 1):
				$rating = 0.5;
				break;
			case ($rating < 3 && $rating >= 2):
				$rating = 1;
				break;
			case ($rating < 4 && $rating >= 3):
				$rating = 1.5;
				break;
			case ($rating < 5 && $rating >= 4):
				$rating = 2;
				break;
			case ($rating < 6 && $rating >= 5):
				$rating = 2.5;
				break;
			case ($rating < 7 && $rating >= 6):
				$rating = 3;
				break;
			case ($rating < 8 && $rating >= 7 ):
				$rating = 3.5;
				break;
			case ($rating < 9 && $rating >= 8):
				$rating = 4;
				break;
			case ($rating < 10 && $rating > 9):
				$rating = 4.5;
				break;
			case ($rating == 10):
				$rating = 5;
				break;
		}
		
		return $rating;
	}
	
	/**
	 * Send email by phpmailer 
	 *
	 * the default:
	 * 		$from_address is Website Name <noreply@domain>
	 *		$content include a mail template 
	 *
	 * @param string $to 
	 * @param string $subject 
	 * @param string $content 
	 * @param string $from 
	 * @return boolean
	 */
	public static function email($to, $subject, $content, $from = NULL)
	{
		$config = Kohana::config('modou');
		$prefix = '['.$config->title.']';
		
		if ( ! strstr($subject, $prefix))
		{
			$subject = $prefix . ' ' . trim($subject);
		}

		$imailer = iMailer::instance()->subject($subject);
		// STMP server
		if ( ! empty($config->smtp_server['host']) AND ! empty($config->smtp_server['port']))
		{
			$imailer->smtp = $config->smtp_server;
		}
		// send to address
		if (is_array($to))
		{
			$email = $to['email'];
			$imailer->to_address($to['email'], $to['name']);
		}
		else
		{
			$email = $to;
			$imailer->to_address($to);
		}
		// send from address
		if (is_array($from))
		{
			$imailer->from_address($from['email'], $from['name']);
		}
		elseif ( ! empty($from))
		{
			$imailer->from_address($from);
		}
		else
		{
			$domain = substr(str_replace('http://', '', URL::site()), 0, -1);
			$imailer->from_address('noreply@'.$domain, $config->title);
		}
		// mail message
		$content = View::factory('template/mail')
			->set('user', ORM::factory('user')->where('email', '=', $email)->find())
			->set('config', $config)
			->set('content', $content);
			
		$imailer->content($content->render());
		
		return $imailer->send();
	}
	
	/**
	 * Force string
	 * @param string $string
	 * @param string $default
	 * @return string
	 */
	public static function force_string($string, $default = NULL)
	{
		if (is_string($string))
		{
			$string = trim($string);
			if (empty($string) AND strlen($string) == 0)
			{
				$string = $default;
			}
		} 
		else
		{
			$string = $default;
		}
		
		return $string;
	}
	
	/**
	 * General copyright
	 *
	 * @param string $start_year 
	 * @param boolean $by 
	 * @return string
	 */
	public static function copyright($start_year = NULL, $by = TRUE)
	{
		$config = Kohana::config('modou');
		$years = (empty($start_year)) ? date('Y') : $start_year.'-'.date('Y');
		$name = html::anchor(URL::base(), $config['title']);
		$output = '&copy; '.$years.' '.$name;
		
		if ($by)
		{
			$author = html::anchor($config['project']['url'], $config['project']['author']);
			$output .= ' by '.$author.'.';
		}
		elseif (is_array($by))
		{
			$attr = array_key_exists('attr', $by) ? $by['attr'] : NULL;
			$output .= ' by '.HTML::anchor($by['link'], $by['name'], $attr).'.';
		}
		
		return $output;
	}
	
	/**
	 * Make string mixed both english words and chinese words beautiful
	 *
	 * @param string $string 
	 * @param string $fill_before 
	 * @param string $fill_after 
	 * @return string
	 */
	public static function beautify_str($string, $fill_before = TRUE, $fill_after = FALSE)
	{
		if ($fill_before AND preg_match('/^\w/', $string))
		{
			$string = ' '.$string;
		}
		
		if ($fill_after AND preg_match('/\w$/', $string))
		{
			$string = $string.' ';
		}
		
		return $string;
	}
}