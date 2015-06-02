<?php

namespace gereport\authen;

__import('gereport/Request');

use gereport\Request;

class LoginRequest extends Request
{
	/**
	 * @var LoginRouter
	 */
	private $loginRouter;

	public function __construct($loginRouter)
	{
		parent::__construct();
		$this->loginRouter = $loginRouter;
	}

	public function username()
	{
		return $this->valuePost($this->loginRouter->usernameKey());
	}

	public function password()
	{
		return $this->valuePost($this->loginRouter->passwordKey());
	}
}
