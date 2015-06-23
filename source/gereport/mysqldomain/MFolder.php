<?php

namespace gereport\mysqldomain;

use gereport\domain\Entry;
use gereport\domain\Folder;

class MFolder extends MBO implements Folder
{
	public function name()
	{
		return $this->retrieve('folder', 'name');
	}

	public function parentId()
	{
		return $this->retrieve('folder', 'parentId');
	}

	/**
	 * @return Folder[]
	 * @throws \Exception
	 */
	public function subFolders()
	{
		$statement = $this->link->prepare('SELECT `id` from `folder` WHERE `parentId` = ? ORDER BY `name`');
		$statement->bind_param('i', $this->id);
		$ok = $statement->execute();

		$folders = null;
		if ($ok)
		{
			$folders = array();
			$result = $statement->get_result();
			while ($row = $result->fetch_array())
			{
				$folders[] = new MFolder($this->link, $row['id']);
			}
			$result->free_result();
		}

		$statement->close();
		if (!$ok) throw new \Exception('Could not retrieve the folder sub folders');
		return $folders;
	}

	/**
	 * @return Entry[]
	 * @throws \Exception
	 */
	public function entries()
	{
		//$statement = $this->link->prepare('SELECT `id` from `entry` WHERE `folderId` = ? ORDER BY `lastEditedTime` DESC');
		$statement = $this->link->prepare('SELECT `id` from `entry` WHERE `folderId` = ? ORDER BY `title`');
		$statement->bind_param('i', $this->id);
		$ok = $statement->execute();

		$entries = null;
		if ($ok)
		{
			$entries = array();
			$result = $statement->get_result();
			while ($row = $result->fetch_array())
			{
				$entries[] = new MEntry($this->link, $row['id']);
			}
			$result->free_result();
		}

		$statement->close();
		if (!$ok) throw new \Exception('Could not retrieve the folder entries');
		return $entries;
	}

	public function rename($newName)
	{
		if (!$newName) throw new \Exception('The new folder name is empty');

		$statement = $this->link->prepare('
			UPDATE `folder` SET `name` = ? WHERE `id` = ?
		');
		$statement->bind_param('si', $newName, $this->id);

		$message = null;
		if (!$statement->execute())
		{
			$message = 'Could not rename the folder';
		}

		$statement->close();
		if ($message) throw new \Exception($message);
	}

	public function clear()
	{
		foreach ($this->subFolders() as $subFolder)
		{
			$subFolder->clear();
			$this->deleteTableRow('folder', $subFolder->id());
		}
		foreach ($this->entries() as $entry)
		{
			$this->deleteTableRow('entry', $entry->id());
		}
	}
}
