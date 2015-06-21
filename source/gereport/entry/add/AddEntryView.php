<?php

namespace gereport\entry\add;

use gereport\View;

class AddEntryView extends View
{
	/**
	 * @var AddEntryViewInfo
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
		require 'AddEntryHtml.php';
	}
}
