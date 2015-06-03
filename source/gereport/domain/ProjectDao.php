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
	public function findByAll();

	/**
	 * @param $projectId
	 * @return bool
	 */
	public function exists($projectId);

	/**
	 * @param $projectId
	 * @return Project
	 */
	public function findById($projectId);
}
