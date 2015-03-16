<?php

namespace gereport\controller;

__import('controller/Controller');
__import('transaction/EditReportTransaction');
__import('transaction/GetReportContentTransaction');
__import('utils/DatetimeUtils');

use gereport\transaction\EditReportTransaction;
use gereport\transaction\GetReportContentTransaction;
use gereport\utils\DatetimeUtils;
use gereport\view\EditReportView;

class EditReportController extends Controller
{
	/**
	 * @var EditReportView
	 */
	private $view;

	public function __construct($view, $toolbox)
	{
		parent::__construct($toolbox);
		$this->view = $view;
	}

	public function process()
	{
		if ($this->toolbox->request->isPostMethod())
		{
			$tx = new EditReportTransaction(
				$this->view->getReportId(),
				DatetimeUtils::getCurDatetime(),
				$this->view->getContent(),
				$this->toolbox->database);

			$msg = 'Report was edited OK';
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

			if ($err)
			{
				$this->view->setIsActionSuccess(!$err);
				$this->view->setResultMessage($msg);
			}
			else // EDIT SUCCESS
			{
				$this->toolbox->redirector->to($this->view->getNextUrl());
			}
		}
		else // GET method
		{
			$tx = new GetReportContentTransaction($this->view->getReportId(), $this->toolbox->database);
			$msg = '';
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

			$this->view->setIsActionSuccess(!$err);
			$this->view->setResultMessage($msg);

			$this->view->setContent($tx->getContent());
		}

		$this->view->setTitle('Edit report');

		return $this->view;
	}
}
