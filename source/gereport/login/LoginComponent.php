<?php

namespace gereport\login;

use gereport\Component;
use gereport\Redirector;
use gereport\router\IndexRouter;
use gereport\router\LoginRouter;
use gereport\View;

class LoginComponent extends Component implements LoginViewInfo
{
	private $message;
	/**
	 * @var LoginRequest
	 */
	private $loginRequest;
	/**
	 * @var LoginRouter
	 */
	private $loginRouter;

	/**
	 * @return View
	 */
	public function view()
	{
		if ($this->session->hasLogged())
		{
			$this->gotoIndex();
			return null;
		}
		$this->loginRouter = new LoginRouter($this->config->rootUrl());
		$this->loginRequest = new LoginRequest($this->httpRequest, $this->loginRouter);

		if ($this->loginRequest->isPostMethod())
		{
			$id = 0;
			$memberDao = $this->daoFactory->member();
			try
			{
				$member = $memberDao->findByAuthen($this->loginRequest->username(), $this->loginRequest->password());
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
			$this->message = 'Incorrect username or password';
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
		return $this->loginRequest->username();
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
