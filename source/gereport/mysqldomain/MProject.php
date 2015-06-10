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
	/**
	 * @var FieldRetriever
	 */
	private $retriever;

	public function __construct($link, $id)
	{
		$this->link = $link;
		$this->id = $id;
		$this->retriever = new FieldRetriever();
	}

	public function id()
	{
		return $this->id;
	}

	public function name()
	{
		return $this->retriever->retrieve($this->link, 'project', 'name', 'id', $this->id);
	}

	/**
	 * @param $memberId
	 * @return bool
	 */
	public function hasMember($memberId)
	{
		$statement = $this->link->prepare('
			SELECT `memberId` FROM `memberproject` WHERE `memberId` = ? AND `projectId` = ?
		');
		$statement->bind_param('ii', $memberId, $this->id);

		$ok = false;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			$ok = $result->fetch_array() ? true : false;
			$result->free_result();
		}
		$statement->close();

		return $ok;
	}
}
