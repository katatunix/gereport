<?php

namespace gereport\entry;

use gereport\View;

class EntryView extends View
{
	/**
	 * @var EntryViewInfo
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
		require 'EntryHtml.php';
	}
}
