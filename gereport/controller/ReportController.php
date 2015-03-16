<?php

namespace gereport\controller;

__import('controller/controller');
__import('transaction/GetReportsTransaction');
__import('transaction/CheckMemberInProjectTransaction');

use gereport\session\ResultMessage;
use gereport\transaction\CheckMemberInProjectTransaction;
use gereport\transaction\GetReportsTransaction;
use gereport\view\ReportView;

class ReportController extends Controller
{
	/**
	 * @var ReportView
	 */
	private $reportView;

	public function __construct($reportView, $toolbox)
	{
		parent::__construct($toolbox);
		$this->reportView = $reportView;
	}

	public function process()
	{
		$this->processGetReports();
		$this->processCheckAllowAddReport();

		/**
		 * @var $resultMessage ResultMessage
		 */
		$resultMessage = $this->toolbox->session->getResultMessage();
		if ($resultMessage)
		{
			$this->reportView->setResultMessage($resultMessage->content);
			$this->reportView->setIsActionSuccess(!$resultMessage->isError);
			$this->toolbox->session->clearResultMessage();
		}

		return $this->reportView;
	}

	private function processGetReports()
	{
		$tx = new GetReportsTransaction(
			$this->reportView->getProjectId(),
			$this->reportView->getDate(),
			$this->toolbox->session->getLoggedMemberId(),
			$this->toolbox->database);
		try { $tx->execute(); } catch (\Exception $ex) { $this->toolbox->redirector->toIndex(); }

		$this->reportView->setTitle($tx->getProjectName());

		foreach ($tx->getReports() as $report)
		{
			$this->reportView->addReport($report);
		}

		foreach ($tx->getNotReportedMembers() as $username)
		{
			$this->reportView->addNotReportedMember($username);
		}

		$this->reportView->setDate($tx->getDate());
	}

	private function processCheckAllowAddReport()
	{
		$result = false;
		if ($this->toolbox->session->isLogged())
		{
			$tx = new CheckMemberInProjectTransaction(
						$this->toolbox->session->getLoggedMemberId(),
						$this->reportView->getProjectId(),
						$this->toolbox->database);
			$tx->execute();
			$result = $tx->isMemberInProject();
		}

		$this->reportView->setAllowAddReport($result);
	}
}
