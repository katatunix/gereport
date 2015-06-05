<?php

namespace gereport\cpass;

use gereport\domain\MemberDao;
use gereport\Validator;
use gereport\Session;
use gereport\View;

class CpassValidator implements Validator
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

	public function __construct($cpassRequest, $session, $memberDao)
	{
		$this->request = $cpassRequest;
		$this->session = $session;
		$this->memberDao = $memberDao;
	}

	/**
	 * @throws \Exception
	 * @return void
	 */
	public function validate()
	{
		if ($this->accessDenied() || $this->isShowingViewOnly())
		{
			return;
		}

		$member = $this->memberDao->findById($this->memberId());

		$old = $this->request->oldPassword();
		if (!$member->hasPassword($old))
		{
			throw new \Exception('Wrong current password');
		}

		$new = $this->newPassword();
		if (!$new)
		{
			throw new \Exception('New password is empty');
		}
		$confirm = $this->request->confirmPassword();
		if ($new != $confirm)
		{
			throw new \Exception('New and confirm password are not matched');
		}
	}

	public function accessDenied()
	{
		return !$this->session->hasLogged();
	}

	public function isShowingViewOnly()
	{
		return !$this->request->isPostMethod();
	}

	public function memberId()
	{
		return $this->session->loggedMemberId();
	}

	public function newPassword()
	{
		return $this->request->newPassword();
	}
}
