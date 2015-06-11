<?php

namespace gereport\mysqldomain;

use gereport\domain\EntryDao;

class MEntryDao implements EntryDao
{
	/**
	 * @var \mysqli
	 */
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function insert($title, $content, $projectId, $authorId, $createdTime, $lastEditorId, $lastEditedTime)
	{
		if (!$title) throw new \Exception('The entry title is empty');
		if (!$content) throw new \Exception('The entry content is empty');
		if (!$createdTime || !$lastEditedTime) throw new \Exception('The entry time is valid');

		if (!$projectId) $projectId = null;

		$statement = $this->link->prepare('
			INSERT INTO `entry`(`title`, `content`, `projectId`, `authorId`, `createdTime`, `lastEditorId`, `lastEditedTime`)
			VALUES(?, ?, ?, ?, ?, ?, ?)
		');
		$statement->bind_param('ssiisis', $title, $content, $projectId, $authorId, $createdTime, $lastEditorId, $lastEditedTime);

		$ok = $statement->execute() && $this->link->affected_rows > 0;
		$statement->close();
		if (!$ok) throw new \Exception('Could not insert the entry');
	}
}
