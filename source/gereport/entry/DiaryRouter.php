<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:31 PM
 */

namespace gereport\entry;


use gereport\Router;

class DiaryRouter extends Router
{
	const ROUTER = 'diary';

	public function projectIdKey()
	{
		return 'p';
	}

	public function url($projectId)
	{
		return $this->defaultUrl() . '?' . $this->projectIdKey() . '=' . $projectId;
	}

	public function defaultUrl()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
