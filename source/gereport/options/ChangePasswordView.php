<?php

namespace gereport\options;

use gereport\View;

class ChangePasswordView extends View
{
	protected $success;
	protected $message;

	public function __construct($htmlDirPath, $htmlDirUrl, $success, $message)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl, 'Change password');
		$this->success = $success;
		$this->message = $message;
	}

	protected function htmlFileName()
	{
		return 'ChangePasswordHtml.php';
	}
}
