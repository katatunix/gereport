<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:42 PM
 */

namespace gereport\entry\edit;


use gereport\editor\EditorView;
use gereport\View;

class EditEntryView extends View
{
	/**
	 * @var EditEntryViewInfo
	 */
	private $info;

	/**
	 * @var View
	 */
	private $editorView;

	public function __construct($config, $info)
	{
		parent::__construct($config, 'Edit entry');
		$this->info = $info;

		$this->editorView = new EditorView($this->config, null, 'content');
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'EditEntryHtml.php';
	}
}
