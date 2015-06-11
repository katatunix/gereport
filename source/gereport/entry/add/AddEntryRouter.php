<?php

namespace gereport\entry\add;

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

	public function projectIdKey()
	{
		return 'p';
	}
}
