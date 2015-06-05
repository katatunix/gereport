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
	 * @var SidebarValidator
	 */
	private $validator;
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
	
	public function __construct($validator, $reportRouter, $config)
	{
		$this->validator = $validator;
		$this->reportRouter = $reportRouter;
		$this->config = $config;
	}
	
	public function execute()
	{
		$success = true;
		try
		{
			$this->validator->validate();
		}
		catch (\Exception $ex)
		{
			$success = false;
		}

		$this->projects = array();
		if ($success)
		{
			foreach ($this->validator->projects() as $projectId => $name)
			{
				$this->projects[$projectId] = array(
					'name' => $name,
					'url' => $this->reportRouter->url($projectId)
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
