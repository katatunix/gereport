<?php

namespace gereport\cpass;

use gereport\Component;
use gereport\error\Error403View;
use gereport\router\CpassRouter;
use gereport\View;

class CpassComponent extends Component implements CpassViewInfo
{
	private $success, $message;

	/**
	 * @var CpassRouter
	 */
	private $cpassRouter;

	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return new Error403View($this->config);

		$this->success = true;
		$this->message = null;

		$this->cpassRouter = new CpassRouter($this->config->rootUrl());
		$request = new CpassRequest($this->httpRequest, $this->cpassRouter);

		if ($request->isPostMethod())
		{
			try
			{
				$this->daoFactory->member()->findById( $this->session->loggedMemberId() )->changePassword(
					$request->oldPassword(),
					$request->newPassword(),
					$request->confirmPassword()
				);
				$this->success = true;
				$this->message = 'The password has been changed OK';
			}
			catch (\Exception $ex)
			{
				$this->success = false;
				$this->message = $ex->getMessage();
			}
		}

		return new CpassView($this->config, $this);
	}

	public function success()
	{
		return $this->success;
	}

	public function message()
	{
		return $this->message;
	}

	public function oldKey()
	{
		return $this->cpassRouter->oldPasswordKey();
	}

	public function newKey()
	{
		return $this->cpassRouter->newPasswordKey();
	}

	public function confirmKey()
	{
		return $this->cpassRouter->confirmPasswordKey();
	}
}
