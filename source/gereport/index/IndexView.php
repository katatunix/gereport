<?php

namespace gereport\index;

use gereport\View;

class IndexView extends View
{
	public function __construct($config)
	{
		parent::__construct($config, 'Welcome');
	}

	protected function htmlFileName()
	{
		return 'IndexHtml.php';
	}
}
