<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:42 PM
 */

namespace gereport\entry\edit;


use gereport\View;

class EditEntryView extends View
{
	/**
	 * @var EditEntryViewInfo
	 */
	private $info;

	public function __construct($config, $info)
	{
		parent::__construct($config, 'Edit entry');
		$this->info = $info;
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'EditEntryHtml.php';
	}
}
