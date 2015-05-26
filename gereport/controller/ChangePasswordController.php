<?php

namespace gereport\controller;

__import('session/Session');
__import('controller/Controller');
__import('transaction/ChangePasswordTransaction');
__import('view/ChangePasswordView');
__import('view/Error403View');

use gereport\transaction\ChangePasswordTransaction;
use gereport\view\ChangePasswordView;
use gereport\view\Error403View;

class ChangePasswordController extends Controller
{

	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		if (!$this->toolbox->session->isLogged())
		{
			return new Error403View($this->toolbox->urlSource, $this->toolbox->htmlDir);
		}

		$request = $this->toolbox->request;
		$changePasswordView = new ChangePasswordView($this->toolbox->urlSource, $this->toolbox->htmlDir);

		if ($request->isPostMethod())
		{
			$msg = null;
			$success = true;
			$tx = new ChangePasswordTransaction(
				$this->toolbox->session->getLoggedMemberId(),
				$request->getDataPost('oldPassword'),
				$request->getDataPost('newPassword'),
				$request->getDataPost('confirmPassword'),
				$this->toolbox->database);
			try
			{
				$tx->execute();
				$msg = 'Password was changed OK';
				$success = true;
			}
			catch (\Exception $ex)
			{
				$msg = $ex->getMessage();
				$success = false;
			}

			$changePasswordView->setMessage($msg)->setIsSuccess($success);
		}

		$changePasswordView->setTitle('Change password');

		return $changePasswordView;
	}

}
