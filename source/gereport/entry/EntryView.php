<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 6:30 PM
 */

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
