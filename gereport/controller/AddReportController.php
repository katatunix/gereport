<?php

namespace gereport\controller;

__import('controller/Controller');
__import('transaction/AddReportTransaction');
__import('utils/DatetimeUtils');

use gereport\transaction\AddReportTransaction;
use gereport\utils\DatetimeUtils;
use gereport\view\AddReportView;

class AddReportController extends Controller
{
	/**
	 * @var AddReportView
	 */
	private $view;

	public function __construct($view, $toolbox)
	{
		parent::__construct($toolbox);
		$this->view = $view;
	}

	public function process()
	{
		$tx = new AddReportTransaction(
			$this->toolbox->session->getLoggedMemberId(),
			$this->view->getProjectId(),
			$this->view->getDateFor(),
			DatetimeUtils::getCurDatetime(),
			$this->view->getContent(),
			$this->toolbox->database);

		$msg = 'Report was submited OK';
		$err = false;
		try
		{
			$tx->execute();
		}
		catch (\Exception $ex)
		{
			$msg = $ex->getMessage();
			$err = true;
		}

		$this->toolbox->session->setResultMessage($msg, $err);
		$this->toolbox->redirector->to($this->view->getNextUrl());
	}
}
