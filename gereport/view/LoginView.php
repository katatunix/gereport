<?php

namespace gereport\view;

__import('view/View');

class LoginView extends View
{
	private $username;
	private $message;

	public function __construct($urlSource, $htmlDir)
	{
		parent::__construct($urlSource, $htmlDir);
	}

	public function setUsername($val)
	{
		$this->username = $val;
		return $this;
	}

	public function setMessage($val)
	{
		$this->message = $val;
		return $this;
	}

	public function show()
	{
		require $this->htmlDir . 'LoginHtml.php';
	}
}
