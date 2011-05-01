<?php defined('SYSPATH') or die('No direct access allowed.');

$development = array
(
	'default' => array
	(
		'type'       => 'mysql',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname
			 * string   username
			 * string   password
			 * boolean  persistent
			 * string   database
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
			'hostname'   => 'localhost',
			'username'   => 'root',
			'password'   => '',
			'persistent' => FALSE,
			'database'   => 'modou',
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
	'alternate' => array(
		'type'       => 'pdo',
		'connection' => array(
			/**
			 * The following options are available for PDO:
			 *
			 * string   dsn
			 * string   username
			 * string   password
			 * boolean  persistent
			 * string   identifier
			 */
			'dsn'        => 'mysql:host=localhost;dbname=kohana',
			'username'   => 'root',
			'password'   => 'r00tdb',
			'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
);

$producation = array
(
	'default' => array
	(
		'type'       => 'mysql',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname
			 * string   username
			 * string   password
			 * boolean  persistent
			 * string   database
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
			'hostname'   => 'localhost',
			'username'   => FALSE,
			'password'   => FALSE,
			'persistent' => FALSE,
			'database'   => 'kohana',
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
	'alternate' => array(
		'type'       => 'pdo',
		'connection' => array(
			/**
			 * The following options are available for PDO:
			 *
			 * string   dsn
			 * string   username
			 * string   password
			 * boolean  persistent
			 * string   identifier
			 */
			'dsn'        => 'mysql:host=localhost;dbname=kohana',
			'username'   => 'root',
			'password'   => 'r00tdb',
			'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
);

return IN_PRODUCTION ? $producation : $development;

