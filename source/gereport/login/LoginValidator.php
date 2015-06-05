<?php

namespace gereport\login;

use gereport\domain\MemberDao;
use gereport\Validator;
use gereport\Session;

class LoginValidator implements Validator
{
	/**
	 * @var LoginRequest
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

	private $loggedMemberId;

	public function __construct($request, $session, $memberDao)
	{
		$this->request = $request;
		$this->session = $session;
		$this->memberDao = $memberDao;
	}

	/**
	 * @return void
	 */
	public function validate()
	{
		if ($this->session->hasLogged())
		{
			$this->loggedMemberId = $this->session->loggedMemberId();
			return;
		}
		if ($this->isShowingViewOnly())
		{
			return;
		}

		$this->loggedMemberId = $this->memberDao->findIdByAuthen(
			$this->loggedMemberUsername(),
			$this->request->password()
		);
	}

	public function loggedMemberId()
	{
		return $this->loggedMemberId;
	}

	public function isShowingViewOnly()
	{
		return !$this->request->isPostMethod();
	}

	public function loggedMemberUsername()
	{
		return $this->request->username();
	}
}
