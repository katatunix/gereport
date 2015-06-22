<?php

namespace gereport\editor;

use gereport\View;

class EditorView extends View
{
	private $id;

	public function __construct($config, $title, $id)
	{
		parent::__construct($config, $title);
		$this->id = $id;
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'EditorHtml.php';
	}
}
