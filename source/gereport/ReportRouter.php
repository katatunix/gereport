<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:38 PM
 */

namespace gereport;


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
}
