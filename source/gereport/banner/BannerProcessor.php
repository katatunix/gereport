<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 1:59 PM
 */

namespace gereport\banner;


use gereport\domain\MemberDao;
use gereport\Processor;
use gereport\Session;

class BannerProcessor implements Processor
{
	/**
	 * @var Session
	 */
	private $session;
	/**
	 * @var MemberDao
	 */
	private $memberDao;

	private $loggedMemberUsername;

	public function __construct($session, $memberDao)
	{
		$this->session = $session;
		$this->memberDao = $memberDao;
	}

	/**
	 * @return void
	 */
	public function process()
	{
		$memberId = $this->session->loggedMemberId();
		if (!$memberId) return;
		$this->loggedMemberUsername = $this->memberDao->findById($memberId)->username();
	}

	public function loggedMemberUsername()
	{
		return $this->loggedMemberUsername;
	}
}
