<?php

namespace gereport;

__import('gereport/Request');
__import('gereport/authen/LoginRouter');
__import('gereport/authen/LoginController');

use gereport\authen\LoginController;
use gereport\authen\LoginRequest;
use gereport\authen\LoginRouter;
use gereport\authen\LogoutController;
use gereport\authen\LogoutRouter;
use gereport\decorator\Error404Controller;
use gereport\index\IndexController;

class Main
{
	public function main()
	{
		$session = new Session($_SESSION);
		$config = new Config();

		$daoFactory = new DaoFactory();
		$viewFactory = new ViewFactory($config->htmlDirPath(), $config->htmlDirUrl());
		$routerFactory = new RouterFactory($config->rootUrl());
		$factory = new Factory($daoFactory, $viewFactory, $routerFactory);

		$request = new Request($_GET, $_POST, $_SERVER['REQUEST_METHOD'] == 'POST', $_SERVER['REQUEST_URI']);
		$rt = $request->valueGet('rt');
		$controller = null;

		if (!$rt)
		{
			$controller = new IndexController($session, $factory);
		}
		else if ($rt == LoginRouter::ROUTER)
		{
			$loginRequest = new LoginRequest($request, $routerFactory->login());
			$controller = new LoginController($loginRequest, $session, $factory);
		}
		else if ($rt == LogoutRouter::ROUTER)
		{
			$controller = new LogoutController($session, $factory);
		}
		else
		{
			$controller = new Error404Controller($session, $factory);
		}

		$controller->process();
	}
}
