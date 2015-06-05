<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 6:07 PM
 */

namespace gereport\report;


use gereport\Router;

class DeleteReportRouter extends Router
{
	const ROUTER = 'report/delete';

	public function reportIdKey()
	{
		return 'reportId';
	}

	public function nextUrlKey()
	{
		return 'nextUrl';
	}
}
