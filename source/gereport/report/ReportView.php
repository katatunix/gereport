<?php

namespace gereport\view;

__import('view/View');

class ReportView extends View
{
	private $projectId;
	private $date;

	private $isActionSuccess;
	private $resultMessage;

	private $isAllowAddReport;

	private $reports;
	private $notReportedMembers;

	private $currentUri;

	public function __construct($urlSource, $htmlDir, $currentUri)
	{
		parent::__construct($urlSource, $htmlDir);


		$this->isActionSuccess = false;
		$this->isAllowAddReport = false;

		$this->reports = array();
		$this->notReportedMembers = array();

		$this->currentUri = $currentUri;
	}

	public function show()
	{
		require $this->htmlDir . 'ReportHtml.php';
	}

	//============================================================================

	public function setProjectId($pid)
	{
		$this->projectId = $pid;
	}

	public function setDate($date)
	{
		 $this->date = $date;
	}

	public function addReport($report)
	{
		$this->reports[] = $report;
	}

	public function addNotReportedMember($username)
	{
		$this->notReportedMembers[] = $username;
	}

	public function setIsActionSuccess($success)
	{
		$this->isActionSuccess = $success;
	}

	public function setResultMessage($msg)
	{
		$this->resultMessage = $msg;
	}

	public function setAllowAddReport($allow)
	{
		$this->isAllowAddReport = $allow;
	}
}
