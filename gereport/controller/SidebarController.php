<?php

namespace gereport\controller;

__import('controller/controller');
__import('transaction/GetProjectsTransaction');
__import('view/SidebarView');

use gereport\transaction\GetProjectsTransaction;
use gereport\view\SidebarView;

class SidebarController extends Controller
{

	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		$tx = new GetProjectsTransaction($this->toolbox->database);
		$tx->execute();

		$sidebarView = new SidebarView($this->toolbox->urlSource, $this->toolbox->htmlDir);

		foreach ($tx->getProjects() as $project)
		{
			$sidebarView->addProject($project);
		}

		return $sidebarView;
	}

}
