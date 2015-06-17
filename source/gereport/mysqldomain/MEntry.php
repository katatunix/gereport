<?php

namespace gereport\mysqldomain;

use gereport\DatetimeUtils;
use gereport\domain\Entry;

class MEntry extends MBO implements Entry
{
	public function title()
	{
		return $this->retrieve('entry', 'title');
	}

	public function content()
	{
		return $this->retrieve('entry', 'content');
	}

	public function authorUsername()
	{
		$authorId = $this->retrieve('entry', 'authorId');
		return (new MMember($this->link, $authorId))->username();
	}

	public function createdTime()
	{
		return $this->retrieve('entry', 'createdTime');
	}

	public function lastEditorUsername()
	{
		$editorId = $this->retrieve('entry', 'lastEditorId');
		return (new MMember($this->link, $editorId))->username();
	}

	public function lastEditedTime()
	{
		return $this->retrieve('entry', 'lastEditedTime');
	}

	public function update($title, $content, $editorId)
	{
		if (!$title) throw new \Exception('The entry title is empty');
		if (!$content) throw new \Exception('The entry content is empty');

		$statement = $this->link->prepare('
			UPDATE `entry` SET `title` = ?, `content` = ?, `lastEditorId` = ?, `lastEditedTime` = ? WHERE `id` = ?
		');
		$current = DatetimeUtils::getCurDatetime();
		$statement->bind_param('ssisi', $title, $content, $editorId, $current, $this->id);

		$message = null;
		if (!$statement->execute())
		{
			$message = 'Could not update the entry';
		}
		else if ($this->link->affected_rows == 0)
		{
			$message = 'Could not find the entry';
		}

		$statement->close();
		if ($message) throw new \Exception($message);
	}

	public function canBeManuplatedByMember($memberId)
	{
		$projectId = $this->projectId();
		if (!$projectId) return true;

		return (new MProject($this->link, $projectId))->hasMember($memberId);
	}
}
