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

	public function structureArray()
	{
		$structure = array('isFolder' => true, 'name' => $this->name(), 'children' => array());

		// Folders
		$statement = $this->link->prepare('SELECT `id` from `folder` WHERE `parentId` = ?');
		$statement->bind_param('i', $this->id);
		$ok = $statement->execute();

		$childIds = array();
		if ($ok)
		{
			$result = $statement->get_result();
			while ($row = $result->fetch_array())
			{
				$childIds[] = $row['id'];
			}
			$result->free_result();
		}

		$statement->close();
		if (!$ok) throw new \Exception('Could not retrieve the folder structure');

		foreach ($childIds as $folderId)
		{
			$folder = new MFolder($this->link, $folderId);
			$structure['children'][] = $folder->structureArray();
		}

		// Entries
		$statement = $this->link->prepare('SELECT `id` from `entry` WHERE `folderId` = ?');
		$statement->bind_param('i', $this->id);
		$ok = $statement->execute();

		if ($ok)
		{
			$result = $statement->get_result();
			while ($row = $result->fetch_array())
			{
				$childIds[] = $row['id'];
			}
			$result->free_result();
		}

		$statement->close();
		if (!$ok) throw new \Exception('Could not retrieve the folder structure');

		foreach ($childIds as $entryId)
		{
			$entry = new MEntry($this->link, $entryId);
			$structure['children'][] = array('isFolder' => false, 'title' => $entry->title(), 'id' => $entryId);
		}

		return $structure;
	}

	/**
	 * @return Folder[]
	 * @throws \Exception
	 */
	public function subFolders()
	{
		$statement = $this->link->prepare('SELECT `id` from `folder` WHERE `parentId` = ?');
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
		$statement = $this->link->prepare('SELECT `id` from `entry` WHERE `folderId` = ?');
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
		}
		foreach ($this->entries() as $entry)
		{
			$this->deleteTableRow('entry', $entry->id());
		}
	}
}
