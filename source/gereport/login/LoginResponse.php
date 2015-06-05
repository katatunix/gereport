<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 1:13 PM
 */

namespace gereport\login;

use gereport\Config;
use gereport\Redirector;
use gereport\Session;

class LoginResponse implements LoginViewInfo
{
	/**
	 * @var LoginValidator
	 */
	private $validator;
	/**
	 * @var Session
	 */
	private $session;
	/**
	 * @var Redirector
	 */
	private $indexRedirector;
	/**
	 * @var Config
	 */
	private $config;
	/**
	 * @var LoginRouter
	 */
	private $router;

	private $username;
	private $message;

	public function __construct($loginValidator, $session, $indexRedirector, $config, $router)
	{
		$this->validator = $loginValidator;
		$this->session = $session;
		$this->indexRedirector = $indexRedirector;
		$this->config = $config;
		$this->router = $router;
	}

	/**
	 * @return LoginView
	 */
	public function execute()
	{
		// TODO: catch an exception
		$this->validator->validate();

		$memberId = $this->validator->loggedMemberId();
		if ($memberId)
		{
			// Login success or already logged
			$this->session->saveLogin($memberId);
			$this->indexRedirector->redirect();
			return null;
		}

		if ($this->validator->isShowingViewOnly())
		{
			$this->username = '';
			$this->message = null;
		}
		else
		{
			$this->username = $this->validator->loggedMemberUsername();
			$this->message = 'Login failed';
		}

		return new LoginView($this->config, $this);
	}

	public function username()
	{
		return $this->username;
	}

	public function message()
	{
		return $this->message;
	}

	public function usernameKey()
	{
		return $this->router->usernameKey();
	}

	public function passwordKey()
	{
		return $this->router->passwordKey();
	}
}
