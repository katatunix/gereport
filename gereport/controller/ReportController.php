<?php

namespace gereport\controller;

__import('controller/controller');
__import('transaction/GetReportsTransaction');
__import('transaction/CheckMemberInProjectTransaction');
__import('view/ReportView');

use gereport\session\ResultMessage;
use gereport\transaction\CheckMemberInProjectTransaction;
use gereport\transaction\GetReportsTransaction;
use gereport\view\ReportView;

class ReportController extends Controller
{
	/**
	 * @var ReportView
	 */
	private $view;

	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		$request = $this->toolbox->request;
		$this->view = new ReportView( $this->toolbox->urlSource, $this->toolbox->htmlDir, $request->getUri() );
		$projectId = $request->getData('p');

		$this->processGetReports($projectId);
		$this->processCheckAllowAddReport($projectId);

		/**
		 * @var $resultMessage ResultMessage
		 */
		$resultMessage = $this->toolbox->session->getResultMessage();
		if ($resultMessage)
		{
			$this->view->setResultMessage($resultMessage->content);
			$this->view->setIsActionSuccess(!$resultMessage->isError);
			$this->toolbox->session->clearResultMessage();
		}

		$this->view->setProjectId($projectId);
		return $this->view;
	}

	private function processGetReports($projectId)
	{
		$request = $this->toolbox->request;

		$tx = new GetReportsTransaction(
			$projectId,
			$request->getData('d'),
			$this->toolbox->session->getLoggedMemberId(),
			$this->toolbox->database);

		try { $tx->execute(); } catch (\Exception $ex) { $this->toolbox->redirector->toIndex(); }

		$this->view->setTitle( $tx->getProjectName() );

		foreach ($tx->getReports() as $report)
		{
			$this->view->addReport($report);
		}

		foreach ($tx->getNotReportedMembers() as $username)
		{
			$this->view->addNotReportedMember($username);
		}

		$this->view->setDate($tx->getDate());
	}

	private function processCheckAllowAddReport($projectId)
	{
		$result = false;
		if ($this->toolbox->session->isLogged())
		{
			$tx = new CheckMemberInProjectTransaction(
						$this->toolbox->session->getLoggedMemberId(),
						$projectId,
						$this->toolbox->database);
			$tx->execute();
			$result = $tx->isMemberInProject();
		}

		$this->view->setAllowAddReport($result);
	}
}
