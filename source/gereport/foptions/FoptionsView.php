<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/19/2015
 * Time: 11:15 AM
 */

namespace gereport\foptions;


use gereport\View;

class FoptionsView extends View
{
	/**
	 * @var FoptionsViewInfo
	 */
	private $info;

	public function __construct($config, $title, $info)
	{
		parent::__construct($config, $title);
		$this->info = $info;
	}

	public function render()
	{
		require 'FoptionsHtml.php';
	}
}
