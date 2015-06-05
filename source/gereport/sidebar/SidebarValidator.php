<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:25 PM
 */

namespace gereport\sidebar;


use gereport\domain\ProjectDao;
use gereport\Validator;

class SidebarValidator implements Validator
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
	public function validate()
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
