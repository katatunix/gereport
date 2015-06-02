<?php

namespace gereport\authen;

__import('gereport/Controller');
__import('gereport/decorator/MainLayoutController');
__import('gereport/authen/LoginRouter');
__import('gereport/authen/LoginRequest');
__import('gereport/authen/LoginView');

use gereport\Controller;
use gereport\decorator\MainLayoutController;
use gereport\mysqldomain\MySqlMemberDao;
use gereport\View;

class LoginController extends MainLayoutController
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		if ($this->session->hasLogged())
		{
			$this->goIndex();
		}

		$router = new LoginRouter();
		$request = new LoginRequest($router);

		$username = null;
		$message = null;

		if ($request->isPostMethod())
		{
			$username = $request->username();
			$password = $request->password();

			$member = ( new MySqlMemberDao() )->findByAuthen($username, $password);
			if ($member)
			{
				$this->session->saveLogin($member->id());
				$this->goIndex();
			}
			else
			{
				$message = 'Login failed';
			}

		}

		return new LoginView($this->config, $username, $message, $router);
	}
}
