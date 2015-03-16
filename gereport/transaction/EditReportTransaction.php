<?php

namespace gereport\transaction;

__import('transaction/Transaction');

class EditReportTransaction extends Transaction
{
	private $reportId, $datetimeEdit, $content;

	public function __construct($reportId, $datetimeEdit, $content, $database)
	{
		parent::__construct($database);
		$this->reportId		= $reportId;
		$this->datetimeEdit	= $datetimeEdit;
		$this->content		= $content;
	}

	public function execute()
	{
//		if ( !$this->database->hasMember($this->memberId) )
//		{
//			throw new \Exception('The member is not existed!');
//		}
//
//		if ( !$this->database->hasProject($this->projectId) )
//		{
//			throw new \Exception('The project is not existed!');
//		}
//
//		if ( !$this->database->isMemberWorkingForProject($this->memberId, $this->projectId) )
//		{
//			throw new \Exception('The member is not working for the project!');
//		}
//
//		if (!$this->content || !trim($this->content))
//		{
//			throw new \Exception('The report content must not be empty!');
//		}
//
//		$this->database->insertReport($this->memberId, $this->projectId,
//			$this->dateFor, $this->datetimeAdd, $this->content);
	}
}
