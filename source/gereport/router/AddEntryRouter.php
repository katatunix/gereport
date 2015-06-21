<?php

namespace gereport\router;

use gereport\Router;

class AddEntryRouter extends Router
{
	const ROUTER = 'entry/add';

	public function titleKey()
	{
		return 'title';
	}

	public function contentKey()
	{
		return 'content';
	}

	public function folderIdKey()
	{
		return 'f';
	}

	public function url($folderId)
	{
		return $this->rootUrl . self::ROUTER . '?' . $this->folderIdKey() . '=' . $folderId;
	}
}
