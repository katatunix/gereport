<?php

namespace gereport\router;

use gereport\Router;

class DeleteEntryRouter extends Router
{
	const ROUTER = 'entry/delete';

	public function entryIdKey()
	{
		return 'id';
	}

	public function url($entryId)
	{
		return $this->rootUrl . self::ROUTER . '?' . $this->entryIdKey() . '=' . $entryId;
	}
}
