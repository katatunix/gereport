<?php

namespace gereport\cpass;

use gereport\View;

class CpassView extends View
{
	private $info;

	public function __construct($config, $info)
	{
		parent::__construct($config, 'Change password');
		$this->info = $info;
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'CpassHtml.php';
	}
}
