<?php

namespace gereport\report;

use gereport\Component;
use gereport\DatetimeUtils;
use gereport\Message;
use gereport\Redirector;
use gereport\router\AddReportRouter;
use gereport\router\DeleteReportRouter;
use gereport\router\EditReportRouter;
use gereport\router\IndexRouter;
use gereport\router\ReportRouter;
use gereport\View;

class ReportComponent extends Component implements ReportViewInfo
{
	private $date;

	/**
	 * @var Message
	 */
	private $messageObj;

	/**
	 * @var ReportRequest
	 */
	private $request;

	/**
	 * @var ReportRouter
	 */
	private $reportRouter;
	/**
	 * @var AddReportRouter
	 */
	private $addReportRouter;

	/**
	 * @var DeleteReportRouter
	 */
	private $deleteReportRouter;

	/**
	 * @return View
	 */
	public function view()
	{
		$rootUrl = $this->config->rootUrl();

		$this->reportRouter = new ReportRouter($rootUrl);
		$this->request = new ReportRequest($this->httpRequest, $this->reportRouter);

		$projectName = null;
		try
		{
			$projectName = $this->daoFactory->project()->findById($this->projectId())->name();
		}
		catch (\Exception $ex)
		{
			$url = (new IndexRouter($rootUrl))->url();
			(new Redirector( $url ))->redirect();
			return null;
		}

		$this->date = $this->request->date();
		if (!$this->date)
		{
			$this->date = DatetimeUtils::getCurDate();
		}

		if ($this->session->hasMessage())
		{
			$this->messageObj = $this->session->message();
			$this->session->clearMessage();
		}

		$this->addReportRouter = new AddReportRouter($rootUrl);
		$this->deleteReportRouter = new DeleteReportRouter($rootUrl);

		return new ReportView($this->config, 'Report for ' . $projectName, $this);
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
			return $this->daoFactory->project()->findById($this->projectId())
				->hasMember($this->session->loggedMemberId());
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
		return $this->messageObj ? $this->messageObj->content : null;
	}

	public function success()
	{
		return $this->messageObj ? !$this->messageObj->isError : null;
	}

	/**
	 * @return array
	 */
	public function reports()
	{
		$r = $this->config->rootUrl();
		$editRouter = new EditReportRouter($r);

		$arr = array();
		try
		{
			foreach ($this->daoFactory->report()->findByProjectAndDate($this->projectId(), $this->date()) as $report)
			{
				$rid = $report->id();
				$cUrl = $this->request->currentUrl();
				$arr[] = array(
					'id' => $report->id(),
					'memberUsername' => $report->memberUsername(),
					'isVisitor' => $report->isVisitor(),
					'datetimeAdd' => $report->datetimeAdd(),
					'canBeManuplated' => $report->canBeManuplatedByMember($this->session->loggedMemberId()),
					'content' => $report->content(),
					'editUrl' => $editRouter->url($rid, $cUrl),
					'deleteUrl' => $this->deleteReportRouter->url($rid, $cUrl)
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

	public function deleteReportUrl()
	{
		return $this->deleteReportRouter->url();
	}

	public function deleteReportReportIdKey()
	{
		return $this->deleteReportRouter->reportIdKey();
	}

	public function deleteReportNextUrlKey()
	{
		return $this->deleteReportRouter->nextUrlKey();
	}

	public function categoryUrl()
	{
		return $this->reportRouter->url($this->projectId());
	}
}
