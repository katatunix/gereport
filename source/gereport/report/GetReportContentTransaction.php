<?php

namespace gereport\transaction;

use gereport\database\GrDatabase;
use gereport\domainproxy\ReportProxy;
use p8p\Transaction;

class GetReportContentTransaction implements Transaction
{
	private $reportId;
	private $content;

	/**
	 * @var GrDatabase
	 */
	private $database;

	public function __construct($reportId, $database)
	{
		$this->reportId = $reportId;
		$this->content = '';

		$this->database = $database;
	}

	public function execute()
	{
		if ($this->database->hasReport($this->reportId))
		{
			$this->content = (new ReportProxy($this->reportId, $this->database))->getContent();
		}
		else
		{
			throw new \Exception('The report is not existed!');
		}
	}

	public function getContent()
	{
		return $this->content;
	}
}
