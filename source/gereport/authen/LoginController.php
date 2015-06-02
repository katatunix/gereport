<?php

namespace gereport\authen;

__import('gereport/Controller');
__import('gereport/decorator/MainLayoutController');

use gereport\Controller;
use gereport\decorator\MainLayoutController;
use gereport\View;

class LoginController extends MainLayoutController
{
	/**
	 * @var LoginRequest
	 */
	private $request;

	public function __construct($request, $session, $factory)
	{
		parent::__construct($session, $factory);
		$this->request = $request;
	}

	/**
	 * @return View
	 */
	protected function createContentView()
	{
		if ($this->session->hasLogged())
		{
			$this->factory->router()->index()->redirect();
		}

		$router = $this->factory->router()->login();
		$username = null;
		$message = null;

		if ($this->request->isPostMethod())
		{
			$username = $this->request->username();
			$password = $this->request->password();

			$member = $this->factory->dao()->member()->findByAuthen($username, $password);
			if ($member)
			{
				$this->session->saveLogin($member->id());
				$this->factory->router()->index()->redirect();
			}
			else
			{
				$message = 'Login failed';
			}
		}

		$router = $this->factory->router()->login();

		return $this->factory->view()->login($username, $message, $router->usernameKey(), $router->passwordKey());
	}
}
