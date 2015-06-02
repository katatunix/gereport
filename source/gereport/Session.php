<?php

namespace gereport;

__import('gereport/Message');

class Session
{
	private $data;
	private $keyLoggedMemberId;
	private $keyMessage;

	const NON_MEMBER_ID = 0;

	public function __construct()
	{
		session_start();

		$this->data = $_SESSION;

		$this->keyLoggedMemberId = 'gereport_member';
		$this->keyMessage = 'gereport_message';
	}

	public function saveLogin($memberId)
	{
		$this->data[$this->keyLoggedMemberId] = $memberId;
	}

	public function hasLogged()
	{
		return $this->loggedMemberId() != self::NON_MEMBER_ID;
	}

	public function loggedMemberId()
	{
		$key = $this->keyLoggedMemberId;

		if ( !isset($this->data[$key]) ) return self::NON_MEMBER_ID;
		return $this->data[$key];
	}

	public function clearLogin()
	{
		unset($this->data[$this->keyLoggedMemberId]);
	}

	public function saveMessage($content, $isError)
	{
		$this->data[$this->keyMessage] = new Message($content, $isError);
	}

	public function hasMessage()
	{
		return isset($this->data[$this->keyMessage]);
	}

	public function message()
	{
		return $this->data[$this->keyMessage];
	}

	public function clearMessage()
	{
		unset($this->data[$this->keyMessage]);
	}
}
