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
	/**
	 * @var View
	 */
	private $banner;
	/**
	 * @var View
	 */
	private $sidebar;
	/**
	 * @var View
	 */
	private $footer;

	/**
	 * @param Config $config
	 * @param View $content
	 * @param View $banner
	 * @param View $sidebar
	 * @param View $footer
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
