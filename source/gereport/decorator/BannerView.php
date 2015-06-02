<?php

namespace gereport\decorator;

__import('gereport/View');

use gereport\View;

class BannerView extends View
{
	private $username;

	public function __construct($config, $username)
	{
		parent::__construct($config);
		$this->username = $username;
	}

	protected function htmlFileName()
	{
		return 'BannerHtml.php';
	}
}
