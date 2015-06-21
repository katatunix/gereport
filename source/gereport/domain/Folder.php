<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/17/2015
 * Time: 3:14 PM
 */

namespace gereport\domain;


interface Folder
{
	public function id();
	public function name();
	public function rename($newName);
	public function clear();

	/**
	 * @return Folder[]
	 */
	public function subFolders();

	/**
	 * @return Entry[]
	 */
	public function entries();
}
