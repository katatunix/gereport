<?php

namespace gereport;

__import('gereport/Request');
__import('gereport/authen/LoginRouter');
__import('gereport/authen/LoginController');

use gereport\authen\LoginController;
use gereport\authen\LoginRouter;
use gereport\authen\LogoutController;
use gereport\authen\LogoutRouter;
use gereport\decorator\Error404Controller;
use gereport\index\IndexController;

class Main
{
	public function main()
	{
		$rt = (new Request())->valueGet('rt');
		$controller = null;

		if (!$rt)
		{
			$controller = new IndexController();
		}
		else if ($rt == LoginRouter::ROUTER)
		{
			$controller = new LoginController();
		}
		else if ($rt == LogoutRouter::ROUTER)
		{
			$controller = new LogoutController();
		}
		else
		{
			$controller = new Error404Controller();
		}

		$controller->process();
	}
}
