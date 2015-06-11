<?php

namespace gereport\sidebar;

use gereport\Config;
use gereport\domain\ProjectDao;
use gereport\Controller;
use gereport\projecthome\ProjectHomeRouter;
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
		$projectArr = array();
		try
		{
			$projects = $this->projectDao->findByAllAndSortByName();
			$router = new ProjectHomeRouter($this->config->rootUrl());
			foreach ($projects as $proj)
			{
				$projectArr[ $proj->id() ] = array(
					'name' => $proj->name(),
					'url' => $router->url($proj->id())
				);
			}
		}
		catch (\Exception $ex)
		{
			$projectArr = array();
		}
		return $projectArr;
	}
}
