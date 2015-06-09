<?php

namespace gereport\report\delete;

use gereport\Controller;
use gereport\domain\ReportDao;
use gereport\Redirector;
use gereport\Session;
use gereport\View;

class DeleteReportController implements Controller
{
	/**
	 * @var DeleteReportRequest
	 */
	private $request;

	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var ReportDao
	 */
	private $reportDao;

	public function __construct($request, $session, $reportDao)
	{
		$this->request = $request;
		$this->session = $session;
		$this->reportDao = $reportDao;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged())
		{
			return null;
		}

		$error = false;
		$message = null;
		try
		{
			$this->reportDao->delete($this->request->reportId());
			$message = 'The report has been deleted OK';
		}
		catch (\Exception $ex)
		{
			$error = true;
			$message = $ex->getMessage();
		}

		$this->session->saveMessage($message, $error);
		(new Redirector( $this->request->nextUrl() ))->redirect();
		return null;
	}
}
