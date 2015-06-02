<?php

namespace gereport\authen;

class LoginRouter
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
