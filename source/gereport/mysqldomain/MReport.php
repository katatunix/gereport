<?php

namespace gereport\mysqldomain;

use gereport\domain\Report;

class MReport extends MBO implements Report
{
	public function content()
	{
		return $this->retrieve('report', 'content');
	}

	public function datetimeAdd()
	{
		return $this->retrieve('report', 'datetimeAdd');
	}

	public function memberUsername()
	{
		return (new MMember($this->link, $this->memberId()))->username();
	}

	private function memberId()
	{
		return $this->retrieve('report', 'memberId');
	}

	public function isVisitor()
	{
		$projectId = $this->retrieve('report', 'projectId');
		return !(new MProject($this->link, $projectId))->hasMember($this->memberId());
	}

	public function canBeManuplatedByMember($memberId)
	{
		return $this->memberId() == $memberId;
	}

	public function update($content, $datetime)
	{
		if (!$content) throw new \Exception('The report content is empty');
		if (!$datetime) throw new \Exception('The report datetime is empty');

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
}
