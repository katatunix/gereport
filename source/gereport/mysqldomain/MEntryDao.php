<?php

namespace gereport\mysqldomain;

use gereport\DatetimeUtils;
use gereport\domain\Entry;
use gereport\domain\EntryDao;

class MEntryDao extends MSql implements EntryDao
{
	/**
	 * @param $id
	 * @return Entry
	 * @throws \Exception
	 */
	public function findById($id)
	{
		if (!$this->exists('entry', $id)) throw new \Exception('The entry is not found');
		return new MEntry($this->link, $id);
	}

	public function insert($title, $content, $folderId, $authorId)
	{
		if (!$title) throw new \Exception('The entry title is empty');
		if (!$content) throw new \Exception('The entry content is empty');
		if (!$authorId) throw new \Exception('The entry author id is empty');

		$statement = $this->link->prepare('
			INSERT INTO `entry`(
				`title`, `content`, `folderId`, `authorId`, `createdTime`, `lastEditorId`, `lastEditedTime`
			)
			VALUES(?, ?, ?, ?, ?, ?, ?)
		');
		$current = DatetimeUtils::getCurDatetime();
		$statement->bind_param('ssiisis', $title, $content, $folderId, $authorId,
			$current, $authorId, $current);

		$ok = $statement->execute() && $this->link->affected_rows > 0;
		$statement->close();
		if (!$ok) throw new \Exception('Could not insert the entry');

		return $this->link->insert_id;
	}

	public function delete($id)
	{
		$this->deleteTableRow('entry', $id);
	}
}
