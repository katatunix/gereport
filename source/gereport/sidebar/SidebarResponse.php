<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:33 PM
 */

namespace gereport\sidebar;


use gereport\Config;
use gereport\ReportRouter;

class SidebarResponse implements SidebarViewInfo
{
	/**
	 * @var SidebarProcessor
	 */
	private $processor;
	/**
	 * @var ReportRouter
	 */
	private $reportRouter;

	/**
	 * @var array
	 */
	private $projects;

	/**
	 * @var Config
	 */
	private $config;
	
	public function __construct($processor, $reportRouter, $config)
	{
		$this->processor = $processor;
		$this->reportRouter = $reportRouter;
		$this->config = $config;
	}
	
	public function execute()
	{
		$this->processor->process();
		
		$this->projects = array();
		foreach ($this->processor->projects() as $projectId => $name)
		{
			$this->projects[$projectId] = array(
				'name' => $name,
				'url' => $this->reportRouter->url($projectId)
			);
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
