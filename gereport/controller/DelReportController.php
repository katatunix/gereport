<?php

namespace gereport\controller;

__import('controller/Controller');
__import('transaction/DeleteReportTransaction');

use gereport\transaction\DeleteReportTransaction;
use gereport\view\DelReportView;

class DelReportController extends Controller
{
	/**
	 * @var DelReportView
	 */
	private $view;

	public function __construct($view, $toolbox)
	{
		parent::__construct($toolbox);
		$this->view = $view;
	}

	public function process()
	{
		$tx = new DeleteReportTransaction($this->view->getReportId(), $this->toolbox->database);
		$msg = 'Report was deleted OK';
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
