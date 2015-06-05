<?php

namespace gereport\options;

use gereport\View;

class OptionsView extends View
{
	protected $cpassUrl;

	public function __construct($config, $cpassUrl)
	{
		parent::__construct($config, 'Options');
		$this->cpassUrl = $cpassUrl;
	}

	public function render()
	{
		require 'OptionsHtml.php';
	}
}
