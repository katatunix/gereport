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
		return $this->retrieve('content');
	}

	public function datetimeAdd()
	{
		return $this->retrieve('datatimeAdd');
	}

	private function retrieve($field)
	{
		$statement = $this->link->prepare('SELECT `' . $field . '` FROM `report` WHERE `id` = ?');
		$statement->bind_param('i', $this->id);

		$message = null;
		$ret = null;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			if ($row = $result->fetch_array())
			{
				$ret = $row[$field];
			}
			else
			{
				$message = 'The report is not found';
			}
			$result->free_result();
		}
		else
		{
			$message = 'Could not retrieve the report ' . $field;
		}
		$statement->close();
		if ($message) throw new \Exception($message);
		return $ret;
	}

	public function memberUsername()
	{
		return (new MMember($this->link, $this->memberId()))->username();
	}

	public function isPast()
	{
		$projectId = $this->retrieve('projectId');
		(new MProject($this->link, $projectId))->hasMember($this->memberId());
	}

	private function memberId()
	{
		return $this->retrieve('memberId');
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

	public function canBeManuplatedByMember($memberId)
	{
		// TODO: Implement canBeManuplatedByMember() method.
	}
}
