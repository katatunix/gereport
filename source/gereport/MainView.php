<?php

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
	 * @param Config $config
	 * @param View $content
	 * @param View $banner
	 * @param View $sidebar
	 */
	public function __construct($config, $content, $banner, $sidebar)
	{
		parent::__construct($config, $content->title());

		$this->content = $content;
		$this->banner = $banner;
		$this->sidebar = $sidebar;
	}

	public function render()
	{
		require 'MainHtml.php';
	}
}
