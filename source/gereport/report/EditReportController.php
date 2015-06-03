<?php

namespace gereport\controller;

use gereport\transaction\EditReportTransaction;
use gereport\transaction\GetReportContentTransaction;
use gereport\utils\DatetimeUtils;
use gereport\view\EditReportView;
use gereport\view\Error403View;

class EditReportController extends Controller
{
	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		if (!$this->toolbox->session->isLogged())
		{
			return new Error403View($this->toolbox->urlSource, $this->toolbox->htmlDir);
		}

		$request = $this->toolbox->request;
		$view = new EditReportView($this->toolbox->urlSource, $this->toolbox->htmlDir);

		$reportId = $request->getDataGet('id');
		$nextUrl = $request->getDataGet('next');

		$view->setNextUrl($nextUrl);

		if ($request->isPostMethod())
		{
			$content = $request->getDataPost('content');

			$tx = new EditReportTransaction(
				$reportId,
				DatetimeUtils::getCurDatetime(),
				$content,
				$this->toolbox->database);

			$msg = 'Report was saved OK';
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
				$view->setIsActionSuccess(!$err);
				$view->setResultMessage($msg);
				$view->setContent( $content );
			}
			else // EDIT SUCCESS
			{
				$this->toolbox->session->setResultMessage($msg, $err);
				$this->toolbox->redirector->to( $nextUrl );
			}
		}
		else // GET method
		{
			$tx = new GetReportContentTransaction( $reportId, $this->toolbox->database );
			$msg = '';
			$err = false;
			try
			{
				$tx->execute();
				$view->setContent( $tx->getContent() );
			}
			catch (\Exception $ex)
			{
				$msg = $ex->getMessage();
				$err = true;
			}

			$view->setIsActionSuccess(!$err);
			$view->setResultMessage($msg);
		}

		$view->setTitle('Edit report');

		return $view;
	}

}
