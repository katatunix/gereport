<?php

error_reporting(E_ALL);

{
	// Get root dir, e.g. d:/xampp/htdocs/mysite/
	$rootDir = realpath(dirname(__FILE__)) . '/';
	define('__ROOT_DIR', $rootDir);

	// Get root url, e.g. /mysite/
	$rootUrl = '/';
	$phpSelf = $_SERVER['PHP_SELF'];
	$index = strrpos($phpSelf, '/');
	if ($index)
	{
		$rootUrl = substr($phpSelf, 0, $index + 1);
	}
	define('__ROOT_URL', $rootUrl);
}

define('__SOURCE_DIR_PATH', __ROOT_DIR . 'source/');
define('__PHP_EXT', '.php');

function __import($class)
{
	require_once __SOURCE_DIR_PATH . $class . __PHP_EXT;
}

function __class_exists($class)
{
	return file_exists( __SOURCE_DIR_PATH . $class . __PHP_EXT );
}
