<?php

namespace gereport\report\delete;

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

	public function url($reportId, $nextUrl)
	{
		return $this->rootUrl . self::ROUTER . '?'
			. $this->reportIdKey() . '=' . $reportId . '&'
			. $this->nextUrlKey() . '=' . urlencode($nextUrl);
	}
}
