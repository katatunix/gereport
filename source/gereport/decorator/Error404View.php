<?php

namespace gereport\decorator;

__import('gereport/View');

use gereport\View;

class Error404View extends View
{
	public function __construct($config)
	{
		parent::__construct($config, 'Error 404');
	}

	protected function htmlFileName()
	{
		return 'Error404Html.php';
	}
}
