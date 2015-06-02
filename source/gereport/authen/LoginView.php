<?php

namespace gereport\authen;

__import('gereport/View');

use gereport\View;

class LoginView extends View
{
	private $username;
	private $message;
	private $usernameKey;
	private $passwordKey;

	public function __construct($htmlDirPath, $htmlDirUrl, $username, $message, $usernameKey, $passwordKey)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl, 'Login');

		$this->username = $username;
		$this->message = $message;

		$this->usernameKey = $usernameKey;
		$this->passwordKey = $passwordKey;
	}

	protected function htmlFileName()
	{
		return 'LoginHtml.php';
	}
}
