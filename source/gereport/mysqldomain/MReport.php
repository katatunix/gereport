<?php

namespace gereport\mysqldomain;

use gereport\domain\Report;

class MReport implements Report
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

	public function content()
	{
		$statement = $this->link->prepare('SELECT `content` FROM `report` WHERE `id` = ?');
		$statement->bind_param('i', $this->id);
		$statement->execute();

		$result = $statement->get_result();
		$row = $result->fetch_array();
		$content = $row ? $row['content'] : null;

		$result->free_result();
		$statement->close();

		if (!$row) throw new \Exception('The report is not found');
		return $content;
	}

	public function datetimeAdd()
	{
		// TODO: Implement datetimeAdd() method.
	}

	public function memberUsername()
	{
		// TODO: Implement memberUsername() method.
	}

	public function isPast()
	{
		// TODO: Implement isPast() method.
	}

	public function update($content, $datetime)
	{
		if (!$content)
		{
			throw new \Exception('The report content is empty');
		}

		$statement = $this->link->prepare('
			UPDATE `report` SET `content` = ?, `datetimeAdd` = ? WHERE `id` = ?
		');
		$statement->bind_param('ssi', $content, $datetime, $this->id);

		if (!$statement->execute())
		{
			$statement->close();
			throw new \Exception('Database error');
		}

		if ($this->link->affected_rows == 0)
		{
			$statement->close();
			throw new \Exception('The report is not found');
		}
	}
}
