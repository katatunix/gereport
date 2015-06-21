<?php

namespace gereport\router;

use gereport\Router;

class EntryRouter extends Router
{
	const ROUTER = 'entry';

	public function entryIdKey()
	{
		return 'id';
	}

	public function url($entryId)
	{
		return $this->rootUrl . self::ROUTER . '?' . $this->entryIdKey() . '=' . $entryId;
	}
}
