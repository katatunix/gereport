<?php

namespace gereport\controller;

use gereport\Controller;
use gereport\DatetimeUtils;
use gereport\decorator\MainLayoutController;
use gereport\report\EditReportRequest;
use gereport\View;

class EditReportController extends MainLayoutController
{
	/**
	 * @var EditReportRequest
	 */
	private $request;

	public function __construct($request, $session, $factory)
	{
		parent::__construct($session, $factory);
		$this->request = $request;
	}

	/**
	 * @return View
	 */
	protected function createContentView()
	{
		if (!$this->session->hasLogged())
		{
			return $this->factory->view()->error403();
		}

		$nextUrl = $this->request->nextUrl();
		$message = null;
		$content = null;

		if ($this->request->isPostMethod())
		{
			$error = false;

			$content = $this->request->content();
			if (!$content)
			{
				$error = true;
				$message = 'Report content must not be empty';
			}

			if (!$error)
			{
				try
				{
					// TODO
					//$this->factory->dao()->report()->edit( $this->request->reportId(), $content, DatetimeUtils::getCurDatetime() );

					$message = 'Report was saved OK';
				}
				catch (\Exception $ex)
				{
					$error = true;
					$message = $ex->getMessage();
				}
			}

			if ($error)
			{
				return $this->factory->view()->editReport($content, $message, $nextUrl);
			}

			$this->session->saveMessage($message, $error);
			$this->factory->router()->redirectTo($nextUrl);
		}
		else
		{
			$reportId = $this->request->reportId();
			try
			{
				$content = $this->factory->dao()->report()->findById($reportId)->content();
			}
			catch (\Exception $ex)
			{
				$content = null;
				$message = $ex->getMessage();
			}
			return $this->factory->view()->editReport($content, $message, $nextUrl);
		}
	}

	//public function process()
	//{


//		if (!$this->toolbox->session->isLogged())
//		{
//			return new Error403View($this->toolbox->urlSource, $this->toolbox->htmlDir);
//		}
//
//		$request = $this->toolbox->request;
//		$view = new EditReportView($this->toolbox->urlSource, $this->toolbox->htmlDir);
//
//		$reportId = $request->getDataGet('id');
//		$nextUrl = $request->getDataGet('next');
//
//		$view->setNextUrl($nextUrl);
//
//		if ($request->isPostMethod())
//		{
//			$content = $request->getDataPost('content');
//
//			$tx = new EditReportTransaction(
//				$reportId,
//				DatetimeUtils::getCurDatetime(),
//				$content,
//				$this->toolbox->database);
//
//			$msg = 'Report was saved OK';
//			$err = false;
//			try
//			{
//				$tx->execute();
//			}
//			catch (\Exception $ex)
//			{
//				$msg = $ex->getMessage();
//				$err = true;
//			}
//
//			if ($err)
//			{
//				$view->setIsActionSuccess(!$err);
//				$view->setResultMessage($msg);
//				$view->setContent( $content );
//			}
//			else // EDIT SUCCESS
//			{
//				$this->toolbox->session->setResultMessage($msg, $err);
//				$this->toolbox->redirector->to( $nextUrl );
//			}
//		}
//		else // GET method
//		{
//			$tx = new GetReportContentTransaction( $reportId, $this->toolbox->database );
//			$msg = '';
//			$err = false;
//			try
//			{
//				$tx->execute();
//				$view->setContent( $tx->getContent() );
//			}
//			catch (\Exception $ex)
//			{
//				$msg = $ex->getMessage();
//				$err = true;
//			}
//
//			$view->setIsActionSuccess(!$err);
//			$view->setResultMessage($msg);
//		}
//
//		$view->setTitle('Edit report');
//
//		return $view;
//	}


}
