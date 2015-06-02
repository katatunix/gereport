<?php

namespace gereport\options;

use gereport\View;

class ChangePasswordView extends View
{
	private $success;
	private $message;
	private $router;

	public function __construct($config, $success, $message, $router)
	{
		parent::__construct($config, 'Change password');
		$this->success = $success;
		$this->message = $message;
		$this->router = $router;
	}

	protected function htmlFileName()
	{
		return 'ChangePasswordHtml.php';
	}
}
