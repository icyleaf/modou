<?php defined('SYSPATH') or die('No direct script access.');

$config = array
(
	// Project Alpaca
	'project'		=>	array
	(
		'name'			=> 'modou',
		'version'		=> '2.0.2',
		'author'		=> 'icyleaf',
		'url'			=> 'http://icyleaf.com',
	),
	// Display throw exception informations and debug information at bottom of page
	'debug'			=> FALSE,
	
	// Website Maintenance
	'maintenance'	=> FALSE,
	
	// General website settings
	'title'			=> '魔豆 v2',
	'description'	=> '豆瓣网非官方移动版本',
	'keywords'		=> '豆瓣, 书影音, 书评, 广播, 豆邮, 友邻, 同城, 活动, 魔豆, 移动, 非官方, modou, douban, mobile, icyleaf',
	'logo'			=> 'media/images/logo.gif',
	'theme'			=> 'default',
	
	// start_year, left it empty, the default is current year.
	'copyright_year'=> 2009,
	
	// Google Analytics
	'ga_account_id'	=> '',

	'modules'		=> array
	(
		'console'	=> DOCROOT.'modou/console',
	),
);



/**
 * Holiday LOGO
 *
 *	Date format: YYYY-MM-DDThh:mm::ss+hh::mm
 *	E.g, 2009-11-11T11:11:11+08:00
 *	It means Nov. 11th 2009 11:11:11 in Timezone 08:00
 *
 * @author icyleaf
 */
$holiday = array
(
	'start_date'	=> '2009-12-22T00:00:00+08:00',
	'end_date'		=> '2009-12-25T23:59:59+08:00',
	'logo'			=> 'media/images/kohana_xmas.png',
);
if ((strtotime($holiday['start_date']) < time()) AND (strtotime($holiday['end_date']) > time()))
{
	if (Kohana::find_file('media', $holiday['logo']))
	{
		$config['logo'] = $holiday['logo'];
	}
}






return $config;

