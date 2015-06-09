<?php

namespace gereport\report;

use gereport\Config;
use gereport\Controller;
use gereport\domain\ProjectDao;
use gereport\domain\ReportDao;
use gereport\Redirector;
use gereport\Session;
use gereport\View;

class ReportController implements Controller, ReportViewInfo
{
	/**
	 * @var ReportRequest
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
	 * @var ReportRouter
	 */
	private $reportRouter;

	/**
	 * @var ProjectDao
	 */
	private $projectDao;

	/**
	 * @var Redirector
	 */
	private $indexRedirector;

	public function __construct($request, $session, $reportDao, $projectDao, $config, $reportRouter, $indexRedirector)
	{
		$this->request = $request;
		$this->session = $session;
		$this->reportDao = $reportDao;
		$this->projectDao = $projectDao;
		$this->config = $config;
		$this->reportRouter = $reportRouter;
		$this->indexRedirector = $indexRedirector;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		$projectName = null;
		try
		{
			$projectName = $this->projectDao->findById($this->projectId())->name();
		}
		catch (\Exception $ex)
		{
			$this->indexRedirector->redirect();
			return null;
		}

		return new ReportView($this->config, $projectName, $this);
	}

	public function projectId()
	{
		return $this->request->projectId();
	}

	public function date()
	{
		// TODO: Implement date() method.
	}

	public function isAllowAddingReport()
	{
		// TODO: Implement isAllowAddingReport() method.
	}

	public function currentUrl()
	{
		return $this->request->currentUrl();
	}

	public function message()
	{
		return $this->session->hasMessage() ? $this->session->message()->content : null;
	}

	public function success()
	{
		return $this->session->hasMessage() ? !$this->session->message()->isError : null;
	}

	/**
	 * @return array
	 *        Keys: 'memberUsername', 'isPast', 'datetimeAdd', 'canDelete',
	 *                'content', 'editUrl', 'deleteUrl'
	 */
	public function reports()
	{
		// TODO: Implement reports() method.
	}

	/**
	 * @return array
	 */
	public function notReportedMemberUsernames()
	{
		// TODO: Implement notReportedMemberUsernames() method.
	}
}
