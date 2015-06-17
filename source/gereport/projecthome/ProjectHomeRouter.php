<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 1:57 PM
 */

namespace gereport\projecthome;


use gereport\Router;

class ProjectHomeRouter extends Router
{
	const ROUTER = 'project';

	public function projectIdKey()
	{
		return 'p';
	}

	public function url($projectId)
	{
		return $this->rootUrl . self::ROUTER . '?' . $this->projectIdKey() . '=' . $projectId;
	}
}
