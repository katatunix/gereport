<?php

namespace gereport\authen;

use gereport\View;

class LoginView extends View
{
	protected $username;
	protected $message;
	protected $usernameKey;
	protected $passwordKey;

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
