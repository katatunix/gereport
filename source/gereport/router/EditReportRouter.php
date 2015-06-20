<?php

namespace gereport\router;

use gereport\Router;

class EditReportRouter extends Router
{
	const ROUTER = 'report/edit';

	public function reportIdKey()
	{
		return 'id';
	}

	public function contentKey()
	{
		return 'content';
	}

	public function nextUrlKey()
	{
		return 'next';
	}

	public function url($reportId, $nextUrl)
	{
		return $this->rootUrl . self::ROUTER . '?'
		. $this->reportIdKey() . '=' . $reportId . '&'
		. $this->nextUrlKey() . '=' . urlencode($nextUrl);
	}
}
