<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:51 PM
 */

namespace gereport;


class MainView extends View
{
	/**
	 * @var View
	 */
	private $content;
	private $banner, $sidebar, $footer;

	/**
	 * @param $config
	 * @param View $content
	 * @param $banner
	 * @param $sidebar
	 * @param $footer
	 */
	public function __construct($config, $content, $banner, $sidebar, $footer)
	{
		parent::__construct($config, $content->title());

		$this->content = $content;
		$this->banner = $banner;
		$this->sidebar = $sidebar;
		$this->footer = $footer;
	}

	public function render()
	{
		require 'MainHtml.php';
	}
}
