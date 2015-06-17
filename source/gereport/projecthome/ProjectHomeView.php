<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:02 PM
 */

namespace gereport\projecthome;


use gereport\View;

class ProjectHomeView extends View
{
	private $reportUrl, $diaryUrl;

	public function __construct($config, $title, $reportUrl, $diaryUrl)
	{
		parent::__construct($config, $title);
		$this->reportUrl = $reportUrl;
		$this->diaryUrl = $diaryUrl;
	}

	/**
	 * @return void
	 */
	public function render()
	{
		require 'ProjectHomeHtml.php';
	}
}
