<?php

namespace gereport\decorator;

__import('gereport/View');

use gereport\View;

class Error403View extends View
{
	public function __construct($config)
	{
		parent::__construct($config, 'Error 403');
	}
	
	protected function htmlFileName()
	{
		return 'Error403Html.php';
	}
}
