<?php

namespace gereport\index;

use gereport\View;

class IndexView extends View
{
	public function __construct($config)
	{
		parent::__construct($config, 'Welcome');
	}

	public function render()
	{
		require 'IndexHtml.php';
	}
}
