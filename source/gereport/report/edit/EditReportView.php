<?php

namespace gereport\report\edit;

use gereport\View;

class EditReportView extends View
{
	/**
	 * @var EditReportViewInfo
	 */
	private $info;

	public function __construct($config, $info)
	{
		parent::__construct($config, 'Edit report');
		$this->info = $info;
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'EditReportHtml.php';
	}
}
