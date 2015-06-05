<?php

namespace gereport\options;

use gereport\View;

class ChangePasswordView extends View
{
	protected $success;
	protected $message;
	protected $oldPasswordKey, $newPasswordKey, $confirmPasswordKey;

	public function __construct($htmlDirPath, $htmlDirUrl, $success, $message,
								$oldPasswordKey, $newPasswordKey, $confirmPasswordKey)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl, 'Change password');
		$this->success = $success;
		$this->message = $message;

		$this->oldPasswordKey = $oldPasswordKey;
		$this->newPasswordKey = $newPasswordKey;
		$this->confirmPasswordKey = $confirmPasswordKey;
	}

	protected function htmlFileName()
	{
		return 'ChangePasswordHtml.php';
	}
}
