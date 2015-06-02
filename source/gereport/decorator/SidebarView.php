<?php

namespace gereport\decorator;

use gereport\View;

class SidebarView extends View
{
	private $projects;

	public function __construct($config, $projects)
	{
		parent::__construct($config);
		$this->projects = $projects;
	}

	protected function htmlFileName()
	{
		return 'SidebarHtml.php';
	}
}
