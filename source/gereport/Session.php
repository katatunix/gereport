<?php

namespace gereport;

class Session
{
	const KEY_LOGGED = 'gereport_member';
	const KEY_MSG = 'gereport_message';
	const NON_MEMBER_ID = 0;

	public function __construct()
	{
		session_start();
	}

	public function saveLogin($memberId)
	{
		$_SESSION[self::KEY_LOGGED] = $memberId;
	}

	public function hasLogged()
	{
		return $this->loggedMemberId() != self::NON_MEMBER_ID;
	}

	public function loggedMemberId()
	{
		$key = self::KEY_LOGGED;

		if ( !isset($_SESSION[$key]) ) return self::NON_MEMBER_ID;
		return $_SESSION[$key];
	}

	public function clearLogin()
	{
		unset($_SESSION[self::KEY_LOGGED]);
	}

	public function saveMessage($content, $isError)
	{
		$_SESSION[self::KEY_MSG] = new Message($content, $isError);
	}

	public function hasMessage()
	{
		return isset($_SESSION[self::KEY_MSG]);
	}

	/**
	 * @return Message
	 */
	public function message()
	{
		return $_SESSION[self::KEY_MSG];
	}

	public function clearMessage()
	{
		unset($_SESSION[self::KEY_MSG]);
	}
}
