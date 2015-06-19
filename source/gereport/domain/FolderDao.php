<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/19/2015
 * Time: 10:36 AM
 */

namespace gereport\domain;


interface FolderDao
{
	/**
	 * @param $id
	 * @return Folder
	 */
	public function findById($id);

	public function insert($newSubFolderName, $parentFolderId);

	public function delete($id);
}
