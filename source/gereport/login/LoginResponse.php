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
	 * @var LoginProcessor
	 */
	private $loginProcessor;
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
	private $loginRouter;

	private $username;
	private $message;

	public function __construct($loginProcessor, $session, $indexRedirector, $config, $loginRouter)
	{
		$this->loginProcessor = $loginProcessor;
		$this->session = $session;
		$this->indexRedirector = $indexRedirector;
		$this->config = $config;
		$this->loginRouter = $loginRouter;
	}

	/**
	 * @return LoginView
	 */
	public function execute()
	{
		$this->loginProcessor->process();

		$memberId = $this->loginProcessor->loggedMemberId();
		if ($memberId)
		{
			// Login success or already logged
			$this->session->saveLogin($memberId);
			$this->indexRedirector->redirect();
			return null;
		}

		if ($this->loginProcessor->isShowingViewOnly())
		{
			$this->username = null;
			$this->message = null;
		}
		else
		{
			$this->username = $this->loginProcessor->loggedMemberUsername();
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
		return $this->loginRouter->usernameKey();
	}

	public function passwordKey()
	{
		return $this->loginRouter->passwordKey();
	}
}
