<?php

namespace gereport\login;

use gereport\domain\MemberDao;
use gereport\Processor;
use gereport\Session;

class LoginProcessor implements Processor
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
	private $isShowingViewOnly;
	private $loggedMemberUsername;

	public function __construct($request, $session, $memberDao)
	{
		$this->request = $request;
		$this->session = $session;
		$this->memberDao = $memberDao;
	}

	/**
	 * @return void
	 */
	public function process()
	{
		if ($this->session->hasLogged())
		{
			$this->loggedMemberId = $this->session->loggedMemberId();
			return;
		}
		if ( ! $this->request->isPostMethod() )
		{
			$this->isShowingViewOnly = true;
			return;
		}
		$this->loggedMemberUsername = $this->request->username();
		$this->loggedMemberId = $this->memberDao->findIdByAuthen(
			$this->loggedMemberUsername,
			$this->request->password()
		);
	}

	public function loggedMemberId()
	{
		return $this->loggedMemberId;
	}

	public function isShowingViewOnly()
	{
		return $this->isShowingViewOnly;
	}

	public function loggedMemberUsername()
	{
		return $this->loggedMemberUsername;
	}
}
