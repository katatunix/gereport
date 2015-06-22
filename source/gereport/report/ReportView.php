<?php

namespace gereport\report;

use gereport\editor\EditorView;
use gereport\View;

class ReportView extends View
{
	/**
	 * @var ReportViewInfo
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

		$this->editorView = new EditorView($this->config, null, 'reportContent');
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'ReportHtml.php';
	}
}
