<?php

namespace gereport\options;

use gereport\View;

class OptionsView extends View
{
	public function __construct($config)
	{
		parent::__construct($config, 'Change password');
	}

	protected function htmlFileName()
	{
		return 'OptionsHtml.php';
	}
}
