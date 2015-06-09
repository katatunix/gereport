<?php

namespace gereport\report;

use gereport\View;

class ReportView extends View
{
	/**
	 * @var ReportViewInfo
	 */
	private $info;

	public function __construct($config, $title, $info)
	{
		parent::__construct($config, $title);
		$this->info = $info;
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'ReportHtml.php';
	}
}
