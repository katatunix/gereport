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

	public function __construct($request, $urlSource, $htmlDir)
	{
		parent::__construct($request, $urlSource, $htmlDir);

		$this->projectId = $this->request->getData('p');
		$this->date = $this->request->getData('d');

		$this->isActionSuccess = false;
		$this->resultMessage = '';

		$this->isAllowAddReport = false;
		$this->reportIdToDelete = $this->isPostMethod() ? $this->request->getDataPost('reportIdToDelete') : 0;

		$this->reports = array();
		$this->notReportedMembers = array();
	}

	public function show()
	{
		require $this->htmlDir . 'ReportHtml.php';
	}

	//============================================================================

	public function getProjectId()
	{
		return $this->projectId;
	}

	public function getDate()
	{
		return $this->date;
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
