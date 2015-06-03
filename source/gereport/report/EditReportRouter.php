<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 6:20 PM
 */

namespace gereport\report;


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
		return 'nextUrl';
	}
}
