<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:45 PM
 */

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

	public function add($content, $projectId, $dateFor, $datetimeAdd, $memberId)
	{
		$statement = $this->link->prepare('
			INSERT INTO `report`(`memberId`, `projectId`, `dateFor`, `datetimeAdd`, `content`)
			VALUES(?, ?, ?, ?, ?)
		');
		$statement->bind_param('iisss', $memberId, $projectId, $dateFor, $datetimeAdd, $content);
		$statement->execute();
		$statement->close();
	}

	public function delete($reportId)
	{
		$statement = $this->link->prepare('DELETE FROM `report` WHERE `id` = ?');
		$statement->bind_param('i', $reportId);
		$statement->execute();
		$statement->close();
	}

	/**
	 * @param $reportId
	 * @return Report
	 */
	public function findById($reportId)
	{
		return new MReport($this->link, $reportId);
	}
}
