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
	 * @param $id
	 * @return Project
	 */
	public function findById($id);

	/**
	 * @return Project[]
	 */
	public function findByAll();
}
