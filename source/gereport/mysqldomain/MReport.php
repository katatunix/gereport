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

	public function content()
	{
		return $this->retriever->retrieve($this->link, 'report', 'content', 'id', $this->id);
	}

	public function datetimeAdd()
	{
		return $this->retriever->retrieve($this->link, 'report', 'datetimeAdd', 'id', $this->id);
	}

	public function memberUsername()
	{
		return (new MMember($this->link, $this->memberId()))->username();
	}

	public function isPast()
	{
		$projectId = $this->retriever->retrieve($this->link, 'report', 'projectId', 'id', $this->id);
		return (new MProject($this->link, $projectId))->hasMember($this->memberId());
	}

	private function memberId()
	{
		return $this->retriever->retrieve($this->link, 'report', 'memberId', 'id', $this->id);
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
		if (!$statement->execute())
		{
			$message = 'Could not update the report';
		}
		else if ($this->link->affected_rows == 0)
		{
			$message = 'Could not find the report';
		}

		$statement->close();
		if ($message) throw new \Exception($message);
	}

	public function canBeManuplatedByMember($memberId)
	{
		return $this->memberId() == $memberId;
	}
}
