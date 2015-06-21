<?php

namespace gereport\domain;

interface Folder
{
	public function id();
	public function name();
	public function parentId();

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
