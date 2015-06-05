<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 6:06 PM
 */

namespace gereport\cpass;


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