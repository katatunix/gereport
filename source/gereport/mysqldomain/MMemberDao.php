<?php

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

		$memberId = 0;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			if ($row = $result->fetch_array())
			{
				$memberId = $row['id'];
			}
			$result->free_result();
		}

		$statement->close();
		return $memberId;
	}

	/**
	 * @param $memberId
	 * @return Member
	 */
	public function findById($memberId)
	{
		return new MMember($this->link, $memberId);
	}

	/**
	 * @param $projectId
	 * @param $date
	 * @return Member[]
	 */
	public function findByNoReportIn($projectId, $date)
	{
		// TODO: Implement findByNoReportIn() method.
	}
}
