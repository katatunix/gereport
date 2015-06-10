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
	 * @throws \Exception
	 * @return Member[]
	 */
	public function findByNoReportIn($projectId, $date)
	{
		$statement = $this->link->prepare('
			SELECT M.`id`
			FROM `member` M, `memberproject` MP
			WHERE
				M.`id` = MP.`memberId` AND
				MP.`projectId` = ? AND
				M.`id` NOT IN (
					SELECT A.`memberId` FROM `report` A
					WHERE A.`projectId` = ?
						AND A.`dateFor` = ?
				)
			ORDER BY M.`username`');
		$statement->bind_param('iis', $projectId, $projectId, $date);

		$ok = $statement->execute();
		$members = null;
		if ($ok)
		{
			$members = array();
			$result = $statement->get_result();
			while ($row = $result->fetch_array())
			{
				$members[] = new MMember($this->link, $row['id']);
			}
		}
		$statement->close();

		if (!$ok) throw new \Exception('Could not retrieve the no report members');
		return $members;
	}
}
