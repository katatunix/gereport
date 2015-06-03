<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/2/2015
 * Time: 11:07 PM
 */

namespace gereport;

use gereport\domain\MemberDao;
use gereport\domain\PostDao;
use gereport\domain\ProjectDao;
use gereport\mysqldomain\MMemberDao;
use gereport\mysqldomain\MProjectDao;
use gereport\mysqldomain\MReportDao;

class DaoFactory
{
	/**
	 * @var \mysqli
	 */
	private $link;

	public function __construct($host, $username, $password, $dbname)
	{
		$this->link = new \mysqli($host, $username, $password, $dbname);
		if ($this->link->connect_errno)
		{
			throw new \Exception("Could not connect to database server");
		}
		$this->link->query("SET NAMES 'utf8'");
	}

	public function __destruct()
	{
		$this->link->close();
	}

	/**
	 * @return MemberDao
	 */
	public function member()
	{
		return new MMemberDao($this->link);
	}

	/**
	 * @return ProjectDao
	 */
	public function project()
	{
		return new MProjectDao($this->link);
	}

	/**
	 * @return PostDao
	 */
	public function post()
	{
	}

	/**
	 * @return MReportDao
	 */
	public function report()
	{
		return new MReportDao($this->link);
	}
}
