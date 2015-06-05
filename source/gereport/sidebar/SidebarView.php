<?php

namespace gereport\sidebar;

use gereport\View;

class SidebarView extends View
{
	/**
	 * @var SidebarViewInfo
	 */
	private $info;

	public function __construct($config, $info)
	{
		parent::__construct($config);
		$this->info = $info;
	}

	public function render()
	{
		require 'SidebarHtml.php';
	}
}
