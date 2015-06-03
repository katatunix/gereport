<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:44 PM
 */

namespace gereport\mysqldomain;

use gereport\domain\Member;
use gereport\domain\MemberDao;

class MMemberDao implements MemberDao
{
	/**
	 * @var \mysqli
	 */
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	/**
	 * @param $username
	 * @param $password
	 * @return int
	 */
	public function findIdByAuthen($username, $password)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `member` WHERE `username` = ? AND `password` = ?');
		$statement->bind_param('ss', $username, $password);
		$statement->execute();
		$result = $statement->get_result();

		$memberId = 0;
		if ($row = $result->fetch_array())
		{
			$memberId = $row['id'];
		}

		$result->free_result();
		$statement->close();

		return $memberId;
	}

	/**
	 * @param $memberId
	 * @return bool
	 */
	public function exists($memberId)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `member` WHERE `id` = ?');
		$statement->bind_param('i', $memberId);
		$statement->execute();
		$result = $statement->get_result();

		$exists = $result->fetch_array() ? true : false;

		$result->free_result();
		$statement->close();

		return $exists;
	}

	/**
	 * @param $memberId
	 * @return Member
	 */
	public function findById($memberId)
	{
		return new MMember($this->link, $memberId);
	}
}
