<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/5/2015
 * Time: 11:17 PM
 */

namespace gereport\report\add;

use gereport\domain\ReportDao;
use gereport\Redirector;
use gereport\Session;

class AddReportResponse
{
	/**
	 * @var AddReportValidator
	 */
	private $validator;
	/**
	 * @var ReportDao
	 */
	private $reportDao;
	/**
	 * @var Session
	 */
	private $session;

	public function __construct($validator, $session, $reportDao)
	{
		$this->validator = $validator;
		$this->reportDao = $reportDao;
		$this->session = $session;
	}

	public function execute()
	{
		$errorMessage = null;
		try
		{
			$this->validator->validate();
		}
		catch (\Exception $ex)
		{
			$errorMessage = $ex->getMessage();
		}

		if ($this->validator->accessDenied())
		{
			return;
		}

		$request = $this->validator->request();
		$redirector = new Redirector($request->nextUrl());

		if ($errorMessage)
		{
			$this->session->saveMessage($errorMessage, true);
			$redirector->redirect();
			return;
		}

		$error = false;
		$message = 'Report was submitted OK';

		try
		{
			$this->reportDao->add(
				$request->content(),
				$request->projectId(),
				$request->dateFor(),
				$this->validator->datetimeAdd(),
				$this->validator->memberId()
			);
		}
		catch (\Exception $ex)
		{
			$error = true;
			$message = $ex->getMessage();
		}

		$this->session->saveMessage($message, $error);
		$redirector->redirect();
	}
}
