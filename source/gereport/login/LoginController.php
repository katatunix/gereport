<?php

namespace gereport\login;

use gereport\Config;
use gereport\domain\MemberDao;
use gereport\Controller;
use gereport\index\IndexRouter;
use gereport\Redirector;
use gereport\Session;
use gereport\View;

class LoginController implements Controller, LoginViewInfo
{
	/**
	 * @var LoginRequest
	 */
	private $request;

	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var MemberDao
	 */
	private $memberDao;

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var LoginRouter
	 */
	private $router;

	private $message;

	public function __construct($request, $session, $memberDao, $config, $router)
	{
		$this->request = $request;
		$this->session = $session;
		$this->memberDao = $memberDao;
		$this->config = $config;
		$this->router = $router;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if ($this->session->hasLogged())
		{
			$this->gotoIndex();
			return null;
		}

		if ($this->request->isPostMethod())
		{
			$id = 0;
			try
			{
				$member = $this->memberDao->findByAuthen($this->request->username(), $this->request->password());
				if ($member) $id = $member->id();
			}
			catch (\Exception $ex)
			{
				$id = 0;
			}
			if ($id)
			{
				$this->session->saveLogin($id);
				$this->gotoIndex();
				return null;
			}
			$this->message = 'Login failed';
		}

		return new LoginView($this->config, $this);
	}

	private function gotoIndex()
	{
		(new Redirector(
			(new IndexRouter(
				$this->config->rootUrl()
			))->url()
		))->redirect();
	}

	public function username()
	{
		return $this->request->username();
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
