<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:32 PM
 */

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

	public function hasPassword($password)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `member` WHERE `id` = ? AND `password` = ?');
		$statement->bind_param('is', $this->id, $password);
		$statement->execute();
		$result = $statement->get_result();
		$ok = $result->fetch_array() ? true : false;
		$result->free_result();
		$statement->close();
		return $ok;
	}

	public function changePassword($newPassword)
	{
		$statement = $this->link->prepare('UPDATE `member` SET `password` = ? WHERE `id` = ?');
		$statement->bind_param('si', $newPassword, $this->id);
		$statement->execute();
		$statement->close();
	}
}
