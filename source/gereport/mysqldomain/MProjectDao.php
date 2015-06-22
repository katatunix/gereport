<?php

namespace gereport\mysqldomain;

use gereport\domain\ProjectDao;

class MProjectDao extends MSql implements ProjectDao
{
	public function findById($id)
	{
		if (!$this->exists('project', $id)) throw new \Exception('The project is not found');
		return new MProject($this->link, $id);
	}

	public function findByAllAndSortByName()
	{
		$statement = $this->link->prepare('SELECT `id` FROM `project` ORDER BY `name`');

		$projects = null;
		$message = null;

		if ($statement->execute())
		{
			$projects = array();
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
}
