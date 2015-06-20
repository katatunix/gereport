<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:47 PM
 */

namespace gereport\domain;

interface MemberDao
{
	/**
	 * @param $id
	 * @return Member
	 */
	public function findById($id);

	/**
	 * @param $username
	 * @param $password
	 * @return Member
	 */
	public function findByAuthen($username, $password);

	/**
	 * @param $projectId
	 * @param $date
	 * @return Member[]
	 */
	public function findByNoReportIn($projectId, $date);
}
