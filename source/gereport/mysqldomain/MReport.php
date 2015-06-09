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

	public function id()
	{
		return $this->id;
	}

	public function content()
	{
		$statement = $this->link->prepare('SELECT `content` FROM `report` WHERE `id` = ?');
		$statement->bind_param('i', $this->id);

		$message = null;
		$content = null;

		if ($statement->execute())
		{
			$result = $statement->get_result();
			$row = $result->fetch_array();
			if ($row)
			{
				$content = $row['content'];
			}
			else
			{
				$message = 'The report is not found';
			}
			$result->free_result();
		}
		else
		{
			$message = 'Could not retrieve the report content';
		}

		$statement->close();

		if ($message) throw new \Exception($message);
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

		$message = null;
		if ($statement->execute())
		{
			if ($this->link->affected_rows == 0)
			{
				$message = 'Could not find the report';
			}
		}
		else
		{
			$message = 'Could not update the report';
		}

		$statement->close();
		if ($message) throw new \Exception($message);
	}
}
