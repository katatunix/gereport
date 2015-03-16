<?php

namespace gereport\session;

__import('session/ResultMessage');

class Session
{
	const NO_MEMBER_ID = 0;

	private $keyLoggedId;
	private $keyResultMessage;

	public function __construct($keyLoggedId, $keyMessage)
	{
		$this->keyLoggedId = $keyLoggedId;
		$this->keyResultMessage = $keyMessage;
	}

	public function isLogged()
	{
		return $this->getLoggedMemberId() > self::NO_MEMBER_ID;
	}

	public function getLoggedMemberId()
	{
		if (!isset($_SESSION[$this->keyLoggedId])) return self::NO_MEMBER_ID;
		$id = $_SESSION[$this->keyLoggedId];
		return $id ? $id : self::NO_MEMBER_ID;
	}

	public function setLoggedMemberId($memberId)
	{
		$_SESSION[$this->keyLoggedId] = $memberId;
	}

	public function clearLogged()
	{
		unset($_SESSION[$this->keyLoggedId]);
	}

	public function setResultMessage($content, $isError)
	{
		$_SESSION[$this->keyResultMessage] = new ResultMessage($content, $isError);
	}

	public function getResultMessage()
	{
		if (!isset($_SESSION[$this->keyResultMessage])) return null;
		return $_SESSION[$this->keyResultMessage];
	}

	public function clearResultMessage()
	{
		unset($_SESSION[$this->keyResultMessage]);
	}
}
