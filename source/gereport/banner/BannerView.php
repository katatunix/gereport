<?php

namespace gereport\banner;

use gereport\View;

class BannerView extends View
{
	/**
	 * @var BannerViewInfo
	 */
	private $info;

	public function __construct($config, $info)
	{
		parent::__construct($config);
		$this->info = $info;
	}

	public function render()
	{
		require 'BannerHtml.php';
	}
}
