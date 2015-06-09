<?php

namespace gereport\report;

use gereport\Router;

class ReportRouter extends Router
{
	const ROUTER = 'report';

	public function url($projectId)
	{
		return $this->rootUrl . self::ROUTER . '?' . $this->projectIdKey() . '=' . $projectId;
	}

	public function projectIdKey()
	{
		return 'p';
	}

	public function dateKey()
	{
		return 'd';
	}
}
