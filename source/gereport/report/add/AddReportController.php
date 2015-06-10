<?php

namespace gereport\report\add;

use gereport\DatetimeUtils;
use gereport\Controller;
use gereport\domain\ReportDao;
use gereport\Redirector;
use gereport\Session;

class AddReportController implements Controller
{
	/**
	 * @var AddReportRequest
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

	public function process()
	{
		if (!$this->session->hasLogged())
		{
			return null;
		}

		$message = null;
		$isError = false;
		try
		{
			$this->reportDao->insert(
				$this->request->content(),
				$this->request->projectId(),
				$this->request->dateFor(),
				DatetimeUtils::getCurDatetime(),
				$this->session->loggedMemberId()
			);
			$message = 'The report has been submitted OK';
		}
		catch (\Exception $ex)
		{
			$message = $ex->getMessage();
			$isError = true;
		}

		$this->session->saveMessage($message, $isError);
		( new Redirector($this->request->nextUrl()) )->redirect();
		return null;
	}
}
