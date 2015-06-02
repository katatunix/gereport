<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:45 PM
 */

namespace gereport\mysqldomain;

__import('gereport/domain/ProjectDao');

use gereport\domain\Project;
use gereport\domain\ProjectDao;

class MySqlProjectDao implements ProjectDao
{
	/**
	 * @return Project[]
	 */
	public function findByAll()
	{
		// TODO: Implement findByAll() method.
		return array();
	}

	/**
	 * @param $projectId
	 * @return Project
	 */
	public function findById($projectId)
	{
		// TODO: Implement findById() method.
	}
}
