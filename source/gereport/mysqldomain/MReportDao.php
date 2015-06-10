<?php

namespace gereport\mysqldomain;

use gereport\domain\Report;
use gereport\domain\ReportDao;

class MReportDao implements ReportDao
{
	/**
	 * @var \mysqli
	 */
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function insert($content, $projectId, $dateFor, $datetimeAdd, $memberId)
	{
		if (!$content) throw new \Exception('The report content is empty');

		$project = new MProject($this->link, $projectId);
		if (!$project->hasMember($memberId))
		{
			throw new \Exception('The member is not working for the project');
		}

		$statement = $this->link->prepare('
			INSERT INTO `report`(`memberId`, `projectId`, `dateFor`, `datetimeAdd`, `content`)
			VALUES(?, ?, ?, ?, ?)
		');
		$statement->bind_param('iisss', $memberId, $projectId, $dateFor, $datetimeAdd, $content);

		$ok = $statement->execute() && $this->link->affected_rows == 0;
		$statement->close();
		if (!$ok) throw new \Exception('Could not insert the report');
	}

	/**
	 * @param $reportId
	 * @throws \Exception
	 */
	public function delete($reportId)
	{
		$statement = $this->link->prepare('DELETE FROM `report` WHERE `id` = ?');
		$statement->bind_param('i', $reportId);

		$message = null;
		if (!$statement->execute())
		{
			$message = 'Could not delete the report';
		}
		else if ($this->link->affected_rows == 0)
		{
			$message = 'Could not find the report';
		}
		$statement->close();
		if ($message) throw new \Exception($message);
	}

	/**
	 * @param $reportId
	 * @return Report
	 */
	public function findById($reportId)
	{
		return new MReport($this->link, $reportId);
	}

	/**
	 * @param $projectId
	 * @param $date
	 * @throws \Exception
	 * @return Report[]
	 */
	public function findByProjectAndDate($projectId, $date)
	{
		$statement = $this->link->prepare('
			SELECT `id` FROM `report` WHERE `projectId` = ? AND `dateFor` = ? ORDER BY `datetimeAdd` DESC
		');
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
}
