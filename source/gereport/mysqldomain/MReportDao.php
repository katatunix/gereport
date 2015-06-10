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
		// TODO: check the member is working for the project
		$statement = $this->link->prepare('
			INSERT INTO `report`(`memberId`, `projectId`, `dateFor`, `datetimeAdd`, `content`)
			VALUES(?, ?, ?, ?, ?)
		');
		$statement->bind_param('iisss', $memberId, $projectId, $dateFor, $datetimeAdd, $content);
		$message = null;
		if (!$statement->execute()) $message = 'Could not insert the report';
		$statement->close();
		if ($message) throw new \Exception($message);
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
		if ($statement->execute())
		{
			if ($this->link->affected_rows == 0)
			{
				$message = 'Could not find the report';
			}
		}
		else
		{
			$message = 'Could not delete the report';
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
	 * @return Report[]
	 */
	public function findByProjectAndDate($projectId, $date)
	{
		// TODO: Implement findByProjectAndDate() method.
	}
}
