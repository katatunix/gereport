<?php

namespace gereport\sidebar;

use gereport\Config;
use gereport\domain\ProjectDao;
use gereport\Controller;
use gereport\report\ReportRouter;
use gereport\View;

class SidebarController implements Controller, SidebarViewInfo
{
	/**
	 * @var ProjectDao
	 */
	private $projectDao;

	/**
	 * @var Config
	 */
	private $config;

	public function __construct($projectDao, $config)
	{
		$this->projectDao = $projectDao;
		$this->config = $config;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		return new SidebarView($this->config, $this);
	}

	/**
	 * @return array
	 */
	public function projects()
	{
		$projects = array();
		try
		{
			$objects = $this->projectDao->findByAllAndSortByName();
			$reportRouter = new ReportRouter($this->config->rootUrl());
			foreach ($objects as $obj)
			{
				$projects[ $obj->id() ] = array(
					'name' => $obj->name(),
					'url' => $reportRouter->url($obj->id())
				);
			}
		}
		catch (\Exception $ex)
		{
			$projects = array();
		}
		return $projects;
	}
}
