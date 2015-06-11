<?php

namespace gereport\entry;

use gereport\Config;
use gereport\Controller;
use gereport\DatetimeUtils;
use gereport\domain\EntryDao;
use gereport\domain\ProjectDao;
use gereport\error\Error403View;
use gereport\index\IndexRouter;
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
					$this->request->projectId(),
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
		// TODO not found the project???
		$r = $this->config->rootUrl();
		$projectId = $this->request->projectId();
		$breads = array();

		$homeUrl = (new IndexRouter($r))->url();

		$breads[] = array('Home', $homeUrl);
		if (!$projectId)
		{
			$breads[] = array('Overall entries', $homeUrl);
		}
		else
		{
			$projectName = $this->projectDao->findById($projectId)->name();
			$breads[] = array($projectName . ' entries', $homeUrl);
		}

		return $breads;
	}
}
