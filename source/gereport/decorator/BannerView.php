<?php

namespace gereport\decorator;

use gereport\View;

class BannerView extends View
{
	protected $username, $indexUrl, $optionsUrl, $loginUrl, $logoutUrl;

	public function __construct($htmlDirPath, $htmlDirUrl, $username, $indexUrl, $optionsUrl, $loginUrl, $logoutUrl)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl);
		$this->username = $username;
		$this->indexUrl = $indexUrl;
		$this->optionsUrl = $optionsUrl;
		$this->loginUrl = $loginUrl;
		$this->logoutUrl = $logoutUrl;
	}

	protected function htmlFileName()
	{
		return 'BannerHtml.php';
	}
}
