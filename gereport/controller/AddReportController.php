<?php

namespace gereport\controller;

__import('controller/Controller');
__import('transaction/AddReportTransaction');
__import('utils/DatetimeUtils');

use gereport\transaction\AddReportTransaction;
use gereport\utils\DatetimeUtils;

class AddReportController extends Controller
{
	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		$request = $this->toolbox->request;

		if (!$this->toolbox->session->isLogged())
		{
			$msg = 'Access denied';
			$err = true;
		}
		else
		{
			$tx = new AddReportTransaction(
				$this->toolbox->session->getLoggedMemberId(),
				$request->getData('projectId'),
				$request->getData('dateFor'),
				DatetimeUtils::getCurDatetime(),
				$request->getData('content'),
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
		}

		$this->toolbox->session->setResultMessage($msg, $err);
		$this->toolbox->redirector->to( $request->getData('nextUrl') );

		// No view to return
	}
}
