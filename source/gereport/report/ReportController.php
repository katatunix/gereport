<?php

namespace gereport\report;

use gereport\Config;
use gereport\Controller;
use gereport\DaoFactory;
use gereport\DatetimeUtils;
use gereport\index\IndexRouter;
use gereport\Redirector;
use gereport\report\add\AddReportRouter;
use gereport\report\delete\DeleteReportRouter;
use gereport\report\edit\EditReportRouter;
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
	 * @var DaoFactory
	 */
	private $daoFactory;

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var ReportRouter
	 */
	private $reportRouter;

	private $date;

	/**
	 * @var AddReportRouter
	 */
	private $addReportRouter;

	public function __construct($request, $session, $daoFactory, $config, $reportRouter)
	{
		$this->request = $request;
		$this->session = $session;
		$this->daoFactory = $daoFactory;
		$this->config = $config;
		$this->reportRouter = $reportRouter;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		$projectName = null;
		try
		{
			$projectName = $this->daoFactory->project()->findById($this->projectId())->name();
		}
		catch (\Exception $ex)
		{
			(new Redirector( new IndexRouter($this->config->rootUrl()) ))->redirect();
			return null;
		}

		$this->date = $this->request->date();
		if (!$this->date)
		{
			$this->date = DatetimeUtils::getCurDate();
		}

		$this->addReportRouter = new AddReportRouter($this->config->rootUrl());

		return new ReportView($this->config, $projectName, $this);
	}

	public function projectId()
	{
		return $this->request->projectId();
	}

	public function date()
	{
		return $this->date;
	}

	public function isAllowSubmittingReport()
	{
		try
		{
			$this->daoFactory->project()->findById($this->projectId())->hasMember($this->session->loggedMemberId());
			return true;
		}
		catch (\Exception $ex)
		{
			return false;
		}
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
		$r = $this->config->rootUrl();
		$editRouter = new EditReportRouter($r);
		$deleteRouter = new DeleteReportRouter($r);

		$arr = array();
		try
		{
			foreach ($this->daoFactory->report()->findByProjectAndDate($this->projectId(), $this->date()) as $report)
			{
				$rid = $report->id();
				$cUrl = $this->request->currentUrl();
				$arr[] = array(
					'memberUsername' => $report->memberUsername(),
					'isPast' => $report->isPast(),
					'datetimeAdd' => $report->datetimeAdd(),
					'canDelete' => $report->canBeManuplatedByMember($this->session->loggedMemberId()),
					'content' => $report->content(),
					'editUrl' => $editRouter->url($rid, $cUrl),
					'deleteUrl' => $deleteRouter->url($rid, $cUrl)
				);
			}
		}
		catch (\Exception $ex)
		{
			$arr = array();
		}
		return $arr;
	}

	/**
	 * @return array
	 */
	public function notReportedMemberUsernames()
	{
		$usernames = array();
		try
		{
			foreach ($this->daoFactory->member()->findByNoReportIn($this->projectId(), $this->date()) as $member)
			{
				$usernames[] = $member->username();
			}
		}
		catch (\Exception $ex)
		{
			$usernames = array();
		}
		return $usernames;
	}

	public function dateKey()
	{
		return $this->reportRouter->dateKey();
	}

	public function projectIdKey()
	{
		return $this->reportRouter->projectIdKey();
	}

	public function addReportUrl()
	{
		return $this->addReportRouter->url();
	}

	public function addReportProjectIdKey()
	{
		return $this->addReportRouter->projectIdKey();
	}

	public function addReportDateForKey()
	{
		return $this->addReportRouter->dateForKey();
	}

	public function addReportNextUrlKey()
	{
		return $this->addReportRouter->nextUrlKey();
	}

	public function addReportContentKey()
	{
		return $this->addReportRouter->contentKey();
	}
}
