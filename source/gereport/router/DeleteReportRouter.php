<?php

namespace gereport\router;

use gereport\Router;

class DeleteReportRouter extends Router
{
	const ROUTER = 'report/delete';

	public function reportIdKey()
	{
		return 'id';
	}

	public function nextUrlKey()
	{
		return 'next';
	}

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
