<?php

namespace gereport\report\add;

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
}
