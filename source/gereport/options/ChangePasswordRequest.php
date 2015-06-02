<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 6:08 PM
 */

namespace gereport\options;

use gereport\Request;

class ChangePasswordRequest
{
	/**
	 * @var ChangePasswordRouter
	 */
	private $router;

	/**
	 * @var Request
	 */
	private $request;

	public function __construct($request, $router)
	{
		$this->request = $request;
		$this->router = $router;
	}

	public function oldPassword()
	{
		return $this->request->valuePost($this->router->oldPasswordKey());
	}

	public function newPassword()
	{
		return $this->request->valuePost($this->router->newPasswordKey());
	}

	public function confirmPassword()
	{
		return $this->request->valuePost($this->router->confirmPasswordKey());
	}
}
