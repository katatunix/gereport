<?php

namespace gereport\cpass;

use gereport\domain\MemberDao;
use gereport\Processor;
use gereport\Session;
use gereport\View;

class CpassProcessor implements Processor
{
	/**
	 * @var CpassRequest
	 */
	private $request;

	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var MemberDao
	 */
	private $memberDao;

	private $accessDenied, $success, $message;

	public function __construct($cpassRequest, $session, $memberDao)
	{
		$this->request = $cpassRequest;
		$this->session = $session;
		$this->memberDao = $memberDao;
	}

	/**
	 * @return void
	 */
	public function process()
	{
		$this->success = false;
		if (!$this->session->hasLogged())
		{
			$this->accessDenied = true;
			return;
		}

		if (!$this->request->isPostMethod()) return;

		$member = $this->memberDao->findById( $this->session->loggedMemberId() );
		$old = $this->request->oldPassword();
		if (!$member->hasPassword($old))
		{
			$this->message = 'Wrong current password';
			return;
		}
		$new = $this->request->newPassword();
		if (!$new)
		{
			$this->message = 'New password is empty';
			return;
		}
		$confirm = $this->request->confirmPassword();
		if ($new != $confirm)
		{
			$this->message = 'New and confirm password are not matched';
			return;
		}

		$member->changePassword($new);
		$this->success = true;
		$this->message = 'Password was changed OK';
	}

	public function accessDenied()
	{
		return $this->accessDenied;
	}

	public function success()
	{
		return $this->success;
	}

	public function message()
	{
		return $this->message;
	}
}
