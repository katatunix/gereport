<?php

namespace gereport\mysqldomain;

use gereport\domain\Folder;
use gereport\domain\FolderDao;

class MFolderDao extends MDao implements FolderDao
{
	/**
	 * @param $id
	 * @return Folder
	 */
	public function findById($id)
	{
		if (!$this->exists('folder', $id)) return null;
		return new MFolder($this->link, $id);
	}

	public function insert($newSubFolderName, $parentFolderId)
	{
		if (!$newSubFolderName)
		{
			throw new \Exception('The sub-folder name is empty');
		}
		$statement = $this->link->prepare('INSERT INTO `folder`(`name`, `parentId`) VALUES(?, ?)');
		$statement->bind_param('si', $newSubFolderName, $parentFolderId);

		$ok = $statement->execute() && $this->link->affected_rows > 0;
		$statement->close();
		if (!$ok) throw new \Exception('Could not insert the sub-folder');

		return $this->link->insert_id;
	}

	public function delete($id)
	{
		// TODO: delete all sub-folders and entries too
		$this->deleteTableRow('folder', $id);
	}
}
