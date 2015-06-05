<?php

namespace gereport\transaction;

use gereport\database\GrDatabase;
use gereport\domainproxy\ReportProxy;
use p8p\Transaction;

class EditReportTransaction implements Transaction
{
	private $reportId, $datetimeEdit, $content;

	/**
	 * @var GrDatabase
	 */
	private $database;

	public function __construct($reportId, $datetimeEdit, $content, $database)
	{
		$this->reportId		= $reportId;
		$this->datetimeEdit	= $datetimeEdit;
		$this->content		= trim($content);
		$this->database		= $database;
	}

	public function execute()
	{
		if ( !$this->database->hasReport($this->reportId) )
		{
			throw new \Exception('The report is not existed!');
		}

		if (!$this->content)
		{
			throw new \Exception('The report content must not be empty!');
		}

		$report = new ReportProxy($this->reportId, $this->database);
		$report->update($this->content, $this->datetimeEdit);
	}
}
