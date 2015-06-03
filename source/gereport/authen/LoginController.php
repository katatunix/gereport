<?php

namespace gereport\authen;

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

		$username = null;
		$message = null;

		if ($this->request->isPostMethod())
		{
			$username = $this->request->username();
			$password = $this->request->password();

			$memberId = $this->factory->dao()->member()->findIdByAuthen($username, $password);
			if ($memberId)
			{
				$this->session->saveLogin($memberId);
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
