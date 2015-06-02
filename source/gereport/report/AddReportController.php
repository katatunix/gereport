<?php

namespace gereport\controller;

__import('gereport/controller/Controller');
__import('gereport/transaction/AddReportTransaction');
__import('p8p/DatetimeUtils');

use gereport\transaction\AddReportTransaction;
use p8p\DatetimeUtils;
use p8p\Redirector;

class AddReportController extends GrController
{
	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		$request = $this->toolbox->httpRequest;

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

		$this->toolbox->session->setMessage($msg, $err);
		( new Redirector( $request->getData('nextUrl') ) )->go();

		// TODO

		return null;
	}
}
