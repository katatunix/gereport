<?php

namespace gereport\router;

use gereport\Router;

class AddReportRouter extends Router
{
	const ROUTER = 'report/add';

	public function contentKey()
	{
		return 'content';
	}

	public function projectIdKey()
	{
		return 'projectId';
	}

	public function dateForKey()
	{
		return 'dateFor';
	}

	public function nextUrlKey()
	{
		return 'nextUrl';
	}

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
