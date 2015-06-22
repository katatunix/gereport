<?php

namespace gereport\report\edit;

use gereport\editor\EditorView;
use gereport\View;

class EditReportView extends View
{
	/**
	 * @var EditReportViewInfo
	 */
	private $info;

	/**
	 * @var View
	 */
	private $editorView;

	public function __construct($config, $info)
	{
		parent::__construct($config, 'Edit report');
		$this->info = $info;

		$this->editorView = new EditorView($this->config, null, 'content');
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'EditReportHtml.php';
	}
}
