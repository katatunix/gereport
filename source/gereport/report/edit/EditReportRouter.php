<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/6/2015
 * Time: 11:50 AM
 */

namespace gereport\report\edit;


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
