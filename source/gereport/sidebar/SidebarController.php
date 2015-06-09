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

	/**
	 * @var array
	 */
	private $projects;

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
		$this->projects = array();
		try
		{
			$objects = $this->projectDao->findByAll();
		}
		catch (\Exception $ex)
		{
			$objects = null;
		}
		if ($objects)
		{
			$reportRouter = new ReportRouter($this->config->rootUrl());
			foreach ($objects as $obj)
			{
				$this->projects[ $obj->id() ] = array(
					'name' => $obj->name(),
					'url' => $reportRouter->url($obj->id())
				);
			}
		}
		return new SidebarView($this->config, $this);
	}

	/**
	 * @return array
	 */
	public function projects()
	{
		return $this->projects;
	}
}
