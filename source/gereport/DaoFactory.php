<?php

namespace gereport;

use gereport\domain\MemberDao;
use gereport\domain\EntryDao;
use gereport\domain\ProjectDao;
use gereport\domain\ReportDao;
use gereport\mysqldomain\MMemberDao;
use gereport\mysqldomain\MProjectDao;
use gereport\mysqldomain\MReportDao;

class DaoFactory
{
	/**
	 * @var \mysqli
	 */
	private $link;

	/**
	 * @var MemberDao
	 */
	private $member;

	/**
	 * @var ProjectDao
	 */
	private $project;

	/**
	 * @var ReportDao
	 */
	private $report;

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
		if (!$this->member) $this->member = new MMemberDao($this->link);
		return $this->member;
	}

	/**
	 * @return ProjectDao
	 */
	public function project()
	{
		if (!$this->project) $this->project = new MProjectDao($this->link);
		return $this->project;
	}

	/**
	 * @return EntryDao
	 */
	public function entry()
	{
	}

	/**
	 * @return MReportDao
	 */
	public function report()
	{
		if (!$this->report) $this->report = new MReportDao($this->link);
		return $this->report;
	}
}
