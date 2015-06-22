<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:47 PM
 */

namespace gereport\domain;

interface EntryDao
{
	/**
	 * @param $id
	 * @return Entry
	 */
	public function findById($id);

	/**
	 * @param $title
	 * @param $content
	 * @param $folderId
	 * @param $authorId
	 * @return int
	 */
	public function insert($title, $content, $folderId, $authorId);

	public function delete($id);
}
