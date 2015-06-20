<?php

namespace gereport\router;

use gereport\Router;

class CpassRouter extends Router
{
	const ROUTER = 'cpass';

	public function oldPasswordKey()
	{
		return 'oldPassword';
	}

	public function newPasswordKey()
	{
		return 'newPassword';
	}

	public function confirmPasswordKey()
	{
		return 'confirmPassword';
	}

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
