<?php

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
	 * @throws \Exception
	 * @return Project[]
	 */
	public function findByAll()
	{
		$statement = $this->link->prepare('SELECT `id` FROM `project` ORDER BY `name`');
		$projects = array();
		$message = null;

		if ($statement->execute())
		{
			$result = $statement->get_result();
			while ($row = $result->fetch_array())
			{
				$projects[] = new MProject($this->link, $row['id']);
			}
			$result->free_result();
		}
		else
		{
			$message = 'Could not retrieve the project list';
		}
		$statement->close();

		if ($message) throw new \Exception($message);
		return $projects;
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
