<?php

namespace gereport\login;

use gereport\View;

class LoginView extends View
{
	/**
	 * @var LoginViewInfo
	 */
	private $info;

	public function __construct($config, $info)
	{
		parent::__construct($config, 'Login');
		$this->info = $info;
	}

	public function render()
	{
		require 'LoginHtml.php';
	}
}
