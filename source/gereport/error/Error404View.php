<?php

namespace gereport\error;

use gereport\View;

class Error404View extends View
{
	public function __construct($config)
	{
		parent::__construct($config, 'Error 404');
	}

	public function render()
	{
		require 'Error404Html.php';
	}
}
