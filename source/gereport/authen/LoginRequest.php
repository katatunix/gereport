<?php

namespace gereport\authen;

use gereport\BaseRequest;

class LoginRequest extends BaseRequest
{
	/**
	 * @var LoginRouter
	 */
	private $router;

	public function __construct($request, $router)
	{
		parent::__construct($request);
		$this->router = $router;
	}

	public function username()
	{
		return $this->request->valuePost($this->router->usernameKey());
	}

	public function password()
	{
		return $this->request->valuePost($this->router->passwordKey());
	}
}
