<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:45 PM
 */

namespace gereport\mysqldomain;

use gereport\domain\Project;
use gereport\domain\ProjectDao;

class MProjectDao implements ProjectDao
{
	/**
	 * @var \mysqli
	 */
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	/**
	 * @return Project[]
	 */
	public function findByAll()
	{
		$statement = $this->link->prepare('SELECT `id` FROM `project` ORDER BY `name`');
		$statement->execute();
		$result = $statement->get_result();
		$projects = array();
		while ($row = $result->fetch_array())
		{
			$pid = $row['id'];
			$projects[$pid] = new MProject($this->link, $pid);
		}
		$result->free_result();
		$statement->close();
		return $projects;
	}

	/**
	 * @param $projectId
	 * @return bool
	 */
	public function exists($projectId)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `project` WHERE `id` = ?');
		$statement->bind_param('i', $projectId);
		$statement->execute();
		$result = $statement->get_result();

		$exists = $result->fetch_array() ? true : false;

		$result->free_result();
		$statement->close();

		return $exists;
	}

	/**
	 * @param $projectId
	 * @return Project
	 */
	public function findById($projectId)
	{
		return new MProject($this->link, $projectId);
	}
}
