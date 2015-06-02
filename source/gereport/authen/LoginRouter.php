<?php

namespace gereport\authen;

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
}
