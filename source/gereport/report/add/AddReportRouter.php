<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/5/2015
 * Time: 10:10 PM
 */

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
