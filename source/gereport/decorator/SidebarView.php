<?php

namespace gereport\decorator;

use gereport\View;

class SidebarView extends View
{
	protected $projects;

	public function __construct($htmlDirPath, $htmlDirUrl, $projects)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl);
		$this->projects = $projects;
	}

	protected function htmlFileName()
	{
		return 'SidebarHtml.php';
	}
}
