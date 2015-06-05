<?php

namespace gereport\transaction;

use gereport\database\GrDatabase;
use gereport\domainproxy\MemberProxy;
use gereport\domainproxy\ProjectProxy;
use gereport\domainproxy\ReportProxy;
use p8p\DatetimeUtils;
use p8p\Transaction;

class GetReportsTransaction implements Transaction
{
	private $projectId;
	private $date;
	private $callerId;

	private $projectName;
	private $reports;
	private $notReportedMembers;

	/**
	 * @var GrDatabase
	 */
	private $database;

	public function __construct($projectId, $date, $callerId, $database)
	{
		$this->projectId = $projectId;
		$this->date = $date;
		$this->callerId = $callerId;
		$this->database = $database;
	}

	public function execute()
	{
		if (!$this->database->hasProject($this->projectId))
		{
			throw new \Exception('Not found the project!');
		}

		$this->projectName = (new ProjectProxy($this->projectId, $this->database))->getName();

		if (!$this->date) $this->date = DatetimeUtils::getCurDate();

		$caller = null;
		if ($this->callerId) $caller = new MemberProxy($this->callerId, $this->database);

		$this->reports = array();
		foreach ($this->database->findReportsByProjectAndDate($this->projectId, $this->date) as $reportId)
		{
			$report = new ReportProxy($reportId, $this->database);
			$this->reports[] = array
			(
				'id' => $reportId,
				'content' => $report->getContent(),
				'datetimeAdd' => $report->getDatetimeAdd(),
				'memberUsername' => $report->getMemberUsername(),
				'isPast' => $report->isPast(),
				'canDelete' => $caller ? $caller->canDeleteReport($report) : false
			);
		}

		$this->notReportedMembers = array();
		foreach($this->database->findNotReportedMembers($this->projectId, $this->date) as $memberId)
		{
			$this->notReportedMembers[] = (new MemberProxy($memberId, $this->database))->getUsername();
		}
	}

	public function getProjectName()
	{
		return $this->projectName;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getReports()
	{
		return $this->reports;
	}

	public function getNotReportedMembers()
	{
		return $this->notReportedMembers;
	}
}
