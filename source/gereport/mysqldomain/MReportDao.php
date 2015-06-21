<?php

namespace gereport\mysqldomain;

use gereport\DatetimeUtils;
use gereport\domain\ReportDao;

class MReportDao extends MSql implements ReportDao
{
	public function findById($id)
	{
		if (!$this->exists('report', $id)) return null;
		return new MReport($this->link, $id);
	}

	public function findByProjectAndDate($projectId, $date)
	{
		$statement = $this->link->prepare('
			SELECT `id` FROM `report` WHERE `projectId` = ? AND `dateFor` = ? ORDER BY `datetimeAdd` DESC
		');
		$statement->bind_param('is', $projectId, $date);

		$reports = null;
		$ok = $statement->execute();
		if ($ok)
		{
			$reports = array();
			$result = $statement->get_result();
			while ($row = $result->fetch_array())
			{
				$reports[] = new MReport($this->link, $row['id']);
			}
		}
		$statement->close();

		if (!$ok) throw new \Exception('Could not retrieve the report list');
		return $reports;
	}

	public function insert($content, $projectId, $dateFor, $memberId)
	{
		if (!$content) throw new \Exception('The report content is empty');
		if (!$dateFor) throw new \Exception('The report date is empty');

		$project = new MProject($this->link, $projectId);
		if (!$project->hasMember($memberId))
		{
			throw new \Exception('The member is not working for the project');
		}

		$statement = $this->link->prepare('
			INSERT INTO `report`(`memberId`, `projectId`, `dateFor`, `datetimeAdd`, `content`)
			VALUES(?, ?, ?, ?, ?)
		');
		$statement->bind_param('iisss', $memberId, $projectId, $dateFor, DatetimeUtils::getCurDatetime(), $content);

		$ok = $statement->execute() && $this->link->affected_rows > 0;
		$statement->close();
		if (!$ok) throw new \Exception('Could not insert the report');

		return $this->link->insert_id;
	}

	public function delete($id)
	{
		$this->deleteTableRow('report', $id);
	}
}
