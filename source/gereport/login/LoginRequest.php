<?php

namespace gereport\login;

use gereport\BaseRequest;

class LoginRequest extends BaseRequest
{
	/**
	 * @var LoginRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function username()
	{
		return $this->httpRequest->valuePost($this->router->usernameKey());
	}

	public function password()
	{
		return $this->httpRequest->valuePost($this->router->passwordKey());
	}
}
