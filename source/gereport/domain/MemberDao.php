<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:47 PM
 */

namespace gereport\domain;


interface MemberDao {
	/**
	 * @param $username
	 * @param $password
	 * @return Member
	 */
	public function findByAuthen($username, $password);

	/**
	 * @param $memberId
	 * @return Member
	 */
	public function findById($memberId);

}
