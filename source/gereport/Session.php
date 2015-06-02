<?php

namespace gereport;

__import('gereport/Message');

class Session
{
	const KEY_LOGGED = 'gereport_member';
	const KEY_MSG = 'gereport_message';
	const NON_MEMBER_ID = 0;

	private $data;

	public function __construct($data)
	{
		session_start();

		$this->data = $data;
	}

	public function saveLogin($memberId)
	{
		$this->data[self::KEY_LOGGED] = $memberId;
	}

	public function hasLogged()
	{
		return $this->loggedMemberId() != self::NON_MEMBER_ID;
	}

	public function loggedMemberId()
	{
		$key = self::KEY_LOGGED;

		if ( !isset($this->data[$key]) ) return self::NON_MEMBER_ID;
		return $this->data[$key];
	}

	public function clearLogin()
	{
		unset($this->data[self::KEY_LOGGED]);
	}

	public function saveMessage($content, $isError)
	{
		$this->data[self::KEY_MSG] = new Message($content, $isError);
	}

	public function hasMessage()
	{
		return isset($this->data[self::KEY_MSG]);
	}

	public function message()
	{
		return $this->data[self::KEY_MSG];
	}

	public function clearMessage()
	{
		unset($this->data[self::KEY_MSG]);
	}
}
