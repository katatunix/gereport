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

	public function __construct($link, $id)
	{
		$this->link = $link;
		$this->id = $id;
	}

	public function id()
	{
		return $this->id;
	}

	public function username()
	{
		$statement = $this->link->prepare('SELECT `username` FROM `member` WHERE `id` = ?');
		$statement->bind_param('i', $this->id);
		$statement->execute();
		$result = $statement->get_result();
		$row = $result->fetch_array();
		$username = $row['username'];
		$result->free_result();
		$statement->close();
		return $username;
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

		$statement = $this->link->prepare('UPDATE `member` SET `password` = ? WHERE `id` = ?');
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
		$statement = $this->link->prepare('SELECT `id` FROM `member` WHERE `id` = ? AND `password` = ?');
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
