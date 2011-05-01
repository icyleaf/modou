<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Routes Configurations
 */
Route::set('console/api', 'console_<controller>/<action>/<id>(/<index>(/<max>))', array(
		'controller'	=> '\w+',
		'action'		=> '\w+',
		'index'			=> '\d+',
		'max'			=> '\d+',
	))
	->defaults(array(
		'directory'		=> 'console',
	));


Route::set('console', 'console(/<action>(/<id>))', array(
		'action'		=> '\w+',
		'id'			=> '\w+',
	))
	->defaults(array(
		'controller' 	=> 'console',
		'action'		=> 'index',
	));