<?php

namespace gereport\view;

__import('view/View');

class SidebarView extends View
{
	private $projects = array();

	public function __construct($urlSource, $htmlDir)
	{
		parent::__construct($urlSource, $htmlDir);
	}

	public function show()
	{
		require $this->htmlDir . 'SidebarHtml.php';
	}

	public function addProject($project)
	{
		$this->projects[] = $project;
	}
}
