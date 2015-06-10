<?php

namespace gereport\mysqldomain;

use gereport\domain\Member;

class MMember implements Member
{
	/**
	 * @var \mysqli
	 */
	private $link;
	private $id;
	/**
	 * @var FieldRetriever
	 */
	private $retriever;

	const MEMBER_TABLE = 'member';

	public function __construct($link, $id)
	{
		$this->link = $link;
		$this->id = $id;
		$this->retriever = new FieldRetriever();
	}

	public function id()
	{
		return $this->id;
	}

	public function username()
	{
		return $this->retriever->retrieve($this->link, self::MEMBER_TABLE, 'username', 'id', $this->id);
	}

	public function changePassword($old, $new, $confirm)
	{
		if (!$new)
		{
			throw new \Exception('The new password is empty');
		}

		if ($new != $confirm)
		{
			throw new \Exception('The new and confirm password are not matched');
		}

		if (!$this->hasPassword($old))
		{
			throw new \Exception('The current password is wrong');
		}

		$statement = $this->link->prepare('UPDATE `' . self::MEMBER_TABLE . '` SET `password` = ? WHERE `id` = ?');
		$statement->bind_param('si', $new, $this->id);
		$ok = $statement->execute();
		$statement->close();

		if (!$ok)
		{
			throw new \Exception('Could not change the password');
		}
	}

	private function hasPassword($password)
	{
		$statement = $this->link->prepare(
			'SELECT `id` FROM `' . self::MEMBER_TABLE . '` WHERE `id` = ? AND `password` = ?');
		$statement->bind_param('is', $this->id, $password);

		$ok = false;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			$ok = $result->fetch_array() ? true : false;
			$result->free_result();
		}
		$statement->close();

		return $ok;
	}
}
