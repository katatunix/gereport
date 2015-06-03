<?php

namespace gereport;

use gereport\authen\LoginController;
use gereport\authen\LoginRequest;
use gereport\authen\LoginRouter;
use gereport\authen\LogoutController;
use gereport\authen\LogoutRouter;
use gereport\decorator\Error404Controller;
use gereport\index\IndexController;
use gereport\options\ChangePasswordController;
use gereport\options\ChangePasswordRequest;
use gereport\options\ChangePasswordRouter;
use gereport\options\OptionsController;
use gereport\options\OptionsRouter;

class Main
{
	public function main()
	{
		$session = new Session();
		$config = new Config();

		$daoFactory = new DaoFactory('localhost', 'root', '', 'gereport');
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
		else if ($rt == OptionsRouter::ROUTER)
		{
			$controller = new OptionsController($session, $factory);
		}
		else if ($rt == ChangePasswordRouter::ROUTER)
		{
			$cpassRequest = new ChangePasswordRequest($request, $routerFactory->cpass());
			$controller = new ChangePasswordController($cpassRequest, $session, $factory);
		}
		else
		{
			$controller = new Error404Controller($session, $factory);
		}

		$controller->process();
	}
}
