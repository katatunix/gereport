<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:44 PM
 */

namespace gereport\mysqldomain;

__import('gereport/domain/MemberDao');

use gereport\domain\Member;
use gereport\domain\MemberDao;

class MySqlMemberDao implements MemberDao
{
	/**
	 * @param $username
	 * @param $password
	 * @return Member
	 */
	public function findByAuthen($username, $password)
	{
		// TODO: Implement findByAuthen() method.
	}

	/**
	 * @param $memberId
	 * @return Member
	 */
	public function findById($memberId)
	{
		// TODO: Implement findById() method.
	}
}
