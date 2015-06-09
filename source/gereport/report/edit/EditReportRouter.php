<?php

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
		return 'next';
	}
}
