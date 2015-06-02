<?php

namespace gereport\transaction;

__import('p8p/Transaction');

use gereport\database\GrDatabase;
use p8p\Transaction;

class DeleteReportTransaction implements Transaction
{
	private $reportId;

	/**
	 * @var GrDatabase
	 */
	private $database;

	public function __construct($reportId, $database)
	{
		$this->reportId = $reportId;
		$this->database = $database;
	}

	public function execute()
	{
		$this->database->deleteReport($this->reportId);
	}
}
