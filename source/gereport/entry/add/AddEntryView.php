<?php

namespace gereport\entry\add;

use gereport\editor\EditorView;
use gereport\View;

class AddEntryView extends View
{
	/**
	 * @var AddEntryViewInfo
	 */
	private $info;

	/**
	 * @var View
	 */
	private $editorView;

	public function __construct($config, $title, $info)
	{
		parent::__construct($config, $title);
		$this->info = $info;

		$this->editorView = new EditorView($this->config, null, 'content');
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'AddEntryHtml.php';
	}
}
