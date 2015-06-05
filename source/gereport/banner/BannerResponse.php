<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:03 PM
 */

namespace gereport\banner;

use gereport\Config;

class BannerResponse implements BannerViewInfo
{
	/**
	 * @var BannerProcessor
	 */
	private $processor;
	/**
	 * @var Config
	 */
	private $config;

	private $loggedMemberUsername;
	private $indexUrl, $optionsUrl, $loginUrl, $logoutUrl;

	public function __construct($processor, $config, $indexUrl, $optionsUrl, $loginUrl, $logoutUrl)
	{
		$this->processor = $processor;
		$this->config = $config;

		$this->indexUrl = $indexUrl;
		$this->optionsUrl = $optionsUrl;
		$this->loginUrl = $loginUrl;
		$this->logoutUrl = $logoutUrl;
	}

	public function execute()
	{
		$this->processor->process();
		$this->loggedMemberUsername = $this->processor->loggedMemberUsername();

		return new BannerView($this->config, $this);
	}

	public function loggedMemberUsername()
	{
		return $this->loggedMemberUsername;
	}

	public function indexUrl()
	{
		return $this->indexUrl;
	}

	public function optionsUrl()
	{
		return $this->optionsUrl;
	}

	public function loginUrl()
	{
		return $this->loginUrl;
	}

	public function logoutUrl()
	{
		return $this->logoutUrl;
	}
}