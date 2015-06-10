<?php

namespace gereport\mysqldomain;

use gereport\domain\Project;

class MProject implements Project
{
	/**
	 * @var \mysqli
	 */
	private $link;
	private $id;

	public function __construct($link, $id)
	{
		$this->link = $link;
		$this->id = $id;
	}

	public function id()
	{
		return $this->id;
	}

	public function name()
	{
		$statement = $this->link->prepare('SELECT `name` FROM `project` WHERE `id` = ?');
		$statement->bind_param('i', $this->id);
		$name = null;
		$message = null;

		if ($statement->execute())
		{
			$result = $statement->get_result();
			$row = $result->fetch_array();
			$name = $row['name'];
			$result->free_result();
		}
		else
		{
			$message = 'Could not retrieve the project name';
		}
		$statement->close();

		if ($message) throw new \Exception($message);
		return $name;
	}

	/**
	 * @param $memberId
	 * @return bool
	 */
	public function hasMember($memberId)
	{
		// TODO: Implement hasMember() method.
	}
}
