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
	 * @param $username
	 * @param $password
	 * @return int
	 */
	public function findIdByAuthen($username, $password);

	/**
	 * @param $memberId
	 * @return Member
	 */
	public function findById($memberId);
}
