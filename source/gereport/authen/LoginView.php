<?php

namespace gereport\authen;

__import('gereport/View');

use gereport\View;

class LoginView extends View
{
	private $username;
	private $message;

	/**
	 * @var LoginRouter
	 */
	private $router;

	public function __construct($config, $username, $message, $router)
	{
		parent::__construct($config, 'Login');

		$this->username = $username;
		$this->message = $message;
		$this->router = $router;
	}

	protected function htmlFileName()
	{
		return 'LoginHtml.php';
	}
}
