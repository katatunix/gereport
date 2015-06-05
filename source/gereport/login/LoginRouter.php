<?php

namespace gereport\login;

use gereport\Router;

class LoginRouter extends Router
{
	const ROUTER = 'login';

	public function usernameKey()
	{
		return 'username';
	}

	public function passwordKey()
	{
		return 'password';
	}

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
