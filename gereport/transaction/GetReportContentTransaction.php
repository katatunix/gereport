<?php

namespace gereport\transaction;

__import('transaction/Transaction');
__import('domainproxy/ReportProxy');

use gereport\domainproxy\ReportProxy;

class GetReportContentTransaction extends Transaction
{
	private $reportId;
	private $content;

	public function __construct($reportId, $database)
	{
		parent::__construct($database);
		$this->reportId = $reportId;

		$this->content = '';
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
