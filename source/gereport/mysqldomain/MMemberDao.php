<?php

namespace gereport\mysqldomain;

use gereport\domain\MemberDao;

class MMemberDao extends MDao implements MemberDao
{
	public function findById($id)
	{
		if (!$this->exists('member', $id)) return null;
		return new MMember($this->link, $id);
	}

	public function findByAuthen($username, $password)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `member` WHERE `username` = ? AND `password` = ?');
		$statement->bind_param('ss', $username, $password);

		$member = null;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			if ($row = $result->fetch_array())
			{
				$member = new MMember($this->link, $row['id']);
			}
			$result->free_result();
		}

		$statement->close();
		return $member;
	}

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
