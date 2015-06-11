<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:01 PM
 */

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
		if (!$projectId)
		{
			$url = (new IndexRouter($this->config->rootUrl()))->url();
			(new Redirector($url))->redirect();
			return null;
		}
		$projectName = $this->projectDao->findById($projectId)->name();


		$r = $this->config->rootUrl();
		$reportUrl = (new ReportRouter($r))->url($projectId);
		$diaryUrl = (new DiaryRouter($r))->url($projectId);

		return new ProjectHomeView($this->config, $projectName, $reportUrl, $diaryUrl);
	}
}
