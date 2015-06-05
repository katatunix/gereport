<?php

namespace gereport\error;

use gereport\View;

class Error403View extends View
{
	public function __construct($config)
	{
		parent::__construct($config, 'Error 403');
	}

	public function render()
	{
		require 'Error403Html.php';
	}
}
