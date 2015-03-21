<?php

namespace gereport\transaction;

__import('transaction/Transaction');
__import('domainproxy/ReportProxy');

use gereport\domainproxy\ReportProxy;

class EditReportTransaction extends Transaction
{
	private $reportId, $datetimeEdit, $content;

	public function __construct($reportId, $datetimeEdit, $content, $database)
	{
		parent::__construct($database);
		$this->reportId		= $reportId;
		$this->datetimeEdit	= $datetimeEdit;
		$this->content		= trim($content);
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
