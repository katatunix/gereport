<?php

error_reporting(E_ALL);

{
	// Get root dir, e.g. d:/xampp/htdocs/mysite/
	$__rootDir = realpath(dirname(__FILE__)) . '/';
	define('__ROOT_DIR', $__rootDir);

	// Get root url, e.g. /mysite/
	$__rootUrl = '/';
	$__phpSelf = $_SERVER['PHP_SELF'];
	$__index = strrpos($__phpSelf, '/');
	if ($__index)
	{
		$__rootUrl = substr($__phpSelf, 0, $__index + 1);
	}
	define('__ROOT_URL', $__rootUrl);
}

set_include_path(__ROOT_DIR . 'source/' . PATH_SEPARATOR . get_include_path());

spl_autoload_extensions('.php');
spl_autoload_register('spl_autoload');
