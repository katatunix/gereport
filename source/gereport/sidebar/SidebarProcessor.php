<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:25 PM
 */

namespace gereport\sidebar;


use gereport\domain\ProjectDao;
use gereport\Processor;

class SidebarProcessor implements Processor
{
	/**
	 * @var ProjectDao
	 */
	private $projectDao;

	/**
	 * @var array
	 */
	private $projects;

	public function __construct($projectDao)
	{
		$this->projectDao = $projectDao;
	}

	/**
	 * @return void
	 */
	public function process()
	{
		$this->projects = array();
		foreach ($this->projectDao->findByAll() as $project)
		{
			$this->projects[ $project->id() ] = $project->name();
		}
	}

	public function projects()
	{
		return $this->projects;
	}
}
