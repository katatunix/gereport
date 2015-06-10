<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:48 PM
 */

namespace gereport\domain;


interface ProjectDao
{
	/**
	 * @return Project[]
	 */
	public function findByAllAndSortByName();

	/**
	 * @param $projectId
	 * @return Project
	 */
	public function findById($projectId);
}
