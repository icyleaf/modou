<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Common Init
 */

// Load theme and other modules
$modules = Kohana::modules();
$modules['modou_theme'] = DOCROOT.'modou/themes/'.Kohana::config('modou.theme');
$modou_modules = Kohana::config('modou.modules');
$modules = array_merge($modules, $modou_modules);
Kohana::modules($modules);

// Clean up
unset($modules);

/**
 * Routes Configurations
 */
Route::set('nimiety', 'nimiety')
	->defaults(array(
		'controller' 	=> 'modou',
		'action'		=> 'nimiety',
	));

Route::set('douban/error', 'douban_error')
	->defaults(array(
		'controller' 	=> 'modou',
		'action'		=> 'douban_error',
	));

Route::set('note', 'note(/<id>)', array(
		'id'         => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'note',
		'action'		=> 'index',
	));

Route::set('people', 'people(/<id>)', array(
		'id'        	=> '[\w|-]+',
	))
	->defaults(array(
		'controller' 	=> 'people',
		'action'		=> 'index',
	));
	
Route::set('book', 'book(/<id>)', array(
		'id'         => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'book',
		'action'		=> 'index',
	));

Route::set('movie', 'movie(/<id>)', array(
		'id'         => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'movie',
		'action'		=> 'index',
	));
	
Route::set('tv', 'tv(/<id>)', array(
		'id'         => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'movie',
		'action'		=> 'index',
	));
	
Route::set('music', 'music(/<id>)', array(
		'id'         => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'music',
		'action'		=> 'index',
	));
	
Route::set('event', 'event(/<id>(/<action>(/<index>/(<max>))))', array(
		'action'	 => '\w+',
		'id'         => '\d+',
		'index'      => '\d+',
		'max'        => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'event',
		'action'		=> 'index',
	));

Route::set('doumail', 'doumail/<id>', array(
		'id'         => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'doumail',
		'action'		=> 'get',
	));

Route::set('broadcast', 'broadcast(/<action>(/<index>/(<max>)))', array(
		'action'		=> '\w+',
		'index'         => '\d+',
		'max'           => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'broadcast',
	));

Route::set('doumail/action', 'doumail(/<action>(/<id>))', array(
		'action'	 => '\w+',
		'id'         => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'doumail',
	));

Route::set('broadcast/comments', 'broadcast/comments(/<id>(/<index>/(<max>)))', array(
        'id'			=> '\d+',
        'index'         => '\d+',
        'max'           => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'broadcast',
		'action'		=> 'comments',
	));

Route::set('people', 'people(/<id>(/<action>(/<index>/(<max>))))', array(
		'action'		=> '\w+',
		'id'        	=> '[\w|-]+',
		'index'         => '\d+',
		'max'           => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'people',
	));

Route::set('collection', 'collection(/<action>(/<index>/(<max>)))', array(
		'action'		=> '\w+',
		'index'         => '\d+',
		'max'           => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'collection',
	));

// search
Route::set('search', 'search(/<action>(/<query>(/<index>/(<max>))))', array(
		'action'		=> '\w+',
		'index'         => '\d+',
		'max'           => '\d+',
	))
	->defaults(array(
		'controller' 	=> 'search',
	));
 
// the default entry
Route::set('modou', '(/<controller>(/<action>(/<id>)))', array(
		'controller'	=> '\w+',
		'action'		=> '\w+',
		'id'			=> '\d+',
	))
	->defaults(array(
		'controller' 	=> 'modou',
		'action'		=> 'index',
	));

// the media files
Route::set('media', 'media(/<file>)', array(
		'file' 	=> '.+'
	))
	->defaults(array(
		'controller'	=> 'modou',
		'action'		=> 'media',
		'file'		 	=> NULL,
	));
