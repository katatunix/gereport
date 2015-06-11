<?php

namespace gereport\projecthome;

use gereport\Config;
use gereport\Controller;
use gereport\domain\ProjectDao;
use gereport\entry\DiaryRouter;
use gereport\index\IndexRouter;
use gereport\Redirector;
use gereport\report\ReportRouter;
use gereport\View;

class ProjectHomeController implements Controller
{
	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var ProjectHomeRequest
	 */
	private $request;

	/**
	 * @var ProjectDao
	 */
	private $projectDao;

	public function __construct($request, $config, $projectDao)
	{
		$this->request = $request;
		$this->config = $config;
		$this->projectDao = $projectDao;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		$projectId = $this->request->projectId();
		$projectName = null;
		try
		{
			$projectName = $this->projectDao->findById($projectId)->name();
		}
		catch (\Exception $ex)
		{
			$this->gotoIndex();
			return null;
		}

		$r = $this->config->rootUrl();

		return new ProjectHomeView(
			$this->config, $projectName,
			(new ReportRouter($r))->url($projectId),
			(new DiaryRouter($r))->url($projectId)
		);
	}

	private function  gotoIndex()
	{
		$url = (new IndexRouter($this->config->rootUrl()))->url();
		(new Redirector($url))->redirect();
	}
}
