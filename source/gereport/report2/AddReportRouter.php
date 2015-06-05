<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 5:32 PM
 */

namespace gereport\report;


class AddReportRouter
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
