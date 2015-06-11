<?php

namespace gereport\entry\add;

use gereport\Config;
use gereport\Controller;
use gereport\DatetimeUtils;
use gereport\domain\EntryDao;
use gereport\domain\ProjectDao;
use gereport\error\Error403View;
use gereport\index\IndexRouter;
use gereport\projecthome\ProjectHomeRouter;
use gereport\Redirector;
use gereport\Session;
use gereport\View;

class AddEntryController implements Controller, AddEntryViewInfo
{
	/**
	 * @var AddEntryRequest
	 */
	private $request;
	/**
	 * @var Session
	 */
	private $session;
	/**
	 * @var EntryDao
	 */
	private $entryDao;

	/**
	 * @var ProjectDao
	 */
	private $projectDao;
	/**
	 * @var Config
	 */
	private $config;
	/**
	 * @var AddEntryRouter
	 */
	private $addEntryRouter;

	private $message;
	private $projectName;

	public function __construct($request, $session, $entryDao, $projectDao, $config, $addEntryRouter)
	{
		$this->request = $request;
		$this->session = $session;
		$this->entryDao = $entryDao;
		$this->projectDao = $projectDao;
		$this->config = $config;
		$this->addEntryRouter = $addEntryRouter;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged())
		{
			return new Error403View($this->config);
		}

		$projectId = $this->request->projectId();
		if ($projectId)
		{
			try
			{
				$this->projectName = $this->projectDao->findById($projectId)->name();
			}
			catch (\Exception $ex)
			{
				$url = (new IndexRouter($this->config->rootUrl()))->url();
				(new Redirector($url))->redirect();
				return null;
			}
		}

		$this->message = null;
		if ($this->request->isPostMethod())
		{
			$memberId = $this->session->loggedMemberId();
			$datetime = DatetimeUtils::getCurDatetime();
			try
			{
				$this->entryDao->insert(
					$this->request->title(),
					$this->request->content(),
					$projectId,
					$memberId,
					$datetime,
					$memberId,
					$datetime
				);
			}
			catch (\Exception $ex)
			{
				$this->message = $ex->getMessage();
			}
		}
		return new AddEntryView($this->config, $this);
	}

	public function title()
	{
		return $this->request->title();
	}

	public function content()
	{
		return $this->request->content();
	}

	public function titleKey()
	{
		return $this->addEntryRouter->titleKey();
	}

	public function contentKey()
	{
		return $this->addEntryRouter->contentKey();
	}

	public function message()
	{
		return $this->message;
	}

	public function breadcrumbs()
	{
		$r = $this->config->rootUrl();
		$projectId = $this->request->projectId();
		$breads = array();

		$homeUrl = (new IndexRouter($r))->url();

		if (!$projectId)
		{
			$breads[] = array('Home', $homeUrl);
			$breads[] = array('Diary', $homeUrl);
		}
		else
		{
			$projectUrl = (new ProjectHomeRouter($r))->url($projectId);
			$breads[] = array($this->projectName, $projectUrl);
			$breads[] = array('Diary', $homeUrl);
		}

		return $breads;
	}
}
