<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/19/2015
 * Time: 11:27 AM
 */

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
		// TODO: Implement insert() method.
	}

	public function delete($id)
	{
		// TODO: Implement delete() method.
	}
}
