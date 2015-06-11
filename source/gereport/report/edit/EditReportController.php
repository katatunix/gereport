<?php

namespace gereport\report\edit;

use gereport\Config;
use gereport\DatetimeUtils;
use gereport\domain\ReportDao;
use gereport\error\Error403View;
use gereport\Redirector;
use gereport\Session;
use gereport\Controller;
use gereport\View;

class EditReportController implements Controller, EditReportViewInfo
{
	/**
	 * @var EditReportRequest
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

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var EditReportRouter
	 */
	private $router;

	private $message, $reportContent;

	public function __construct($request, $session, $reportDao, $config, $router)
	{
		$this->request = $request;
		$this->session = $session;
		$this->reportDao = $reportDao;
		$this->config = $config;
		$this->router = $router;
	}

	private function error()
	{
		return new Error403View($this->config);
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged()) return $this->error();

		$report = $this->reportDao->findById($this->request->reportId());
		if (!$report) return $this->error();

		$this->message = null;

		if (!$this->request->isPostMethod())
		{
			try
			{
				$this->reportContent = $report->content();
			}
			catch (\Exception $ex)
			{
				$this->message = $ex->getMessage();
			}
		}
		else
		{
			$this->reportContent = $this->request->content();
			$success = true;
			try
			{
				$report->update($this->reportContent, DatetimeUtils::getCurDatetime());
			}
			catch (\Exception $ex)
			{
				$success = false;
				$this->message = $ex->getMessage();
			}

			if ($success)
			{
				$this->session->saveMessage('The report has been saved OK', false);
				(new Redirector( $this->nextUrl() ))->redirect();
				return null;
			}
		}

		return new EditReportView($this->config, $this);
	}

	public function message()
	{
		return $this->message;
	}

	public function content()
	{
		return $this->reportContent;
	}

	public function contentKey()
	{
		return $this->router->contentKey();
	}

	public function nextUrl()
	{
		return $this->request->nextUrl();
	}
}
