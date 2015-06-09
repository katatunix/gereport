<?php

namespace gereport\entry;

use gereport\View;

class AddEntryView extends View
{
	/**
	 * @var AddEntryViewInfo
	 */
	private $info;

	public function __construct($config, $info)
	{
		parent::__construct($config, 'Add a new post');
		$this->info = $info;
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'AddPostHtml.php';
	}
}
