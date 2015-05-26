<?php

namespace gereport\view;

__import('view/View');

class ChangePasswordView extends View
{
	private $isSuccess;
	private $message;

	public function __construct($urlSource, $htmlDir)
	{
		parent::__construct($urlSource, $htmlDir);
	}

	public function show()
	{
		require $this->htmlDir . 'ChangePasswordHtml.php';
	}

	public function setIsSuccess($success)
	{
		$this->isSuccess = $success;
		return $this;
	}

	public function setMessage($msg)
	{
		$this->message = $msg;
		return $this;
	}
}
