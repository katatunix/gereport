<?php

namespace gereport\controller;

__import('controller/Controller');
__import('transaction/DeleteReportTransaction');

use gereport\transaction\DeleteReportTransaction;

class DeleteReportController extends Controller
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
			$tx = new DeleteReportTransaction( $request->getData('reportId'), $this->toolbox->database );
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
		}

		$this->toolbox->session->setResultMessage($msg, $err);
		$this->toolbox->redirector->to( $request->getData('nextUrl') );
	}

}
