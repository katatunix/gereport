<?php

namespace gereport\view;

__import('view/View');

class BannerView extends View
{
	private $username;

	public function __construct($urlSource, $htmlDir)
	{
		parent::__construct($urlSource, $htmlDir);
	}

	public function show()
	{
		require $this->htmlDir . 'BannerHtml.php';
	}

	public function setUsername($val)
	{
		$this->username = $val;
	}
}
