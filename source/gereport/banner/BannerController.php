<?php

namespace gereport\banner;

use gereport\Config;
use gereport\domain\MemberDao;
use gereport\Controller;
use gereport\index\IndexRouter;
use gereport\login\LoginRouter;
use gereport\logout\LogoutRouter;
use gereport\options\OptionsRouter;
use gereport\Session;
use gereport\View;

class BannerController implements Controller, BannerViewInfo
{
	/**
	 * @var Session
	 */
	private $session;
	/**
	 * @var MemberDao
	 */
	private $memberDao;
	/**
	 * @var Config
	 */
	private $config;

	private $currentUrl;

	public function __construct($session, $memberDao, $config, $currentUrl)
	{
		$this->session = $session;
		$this->memberDao = $memberDao;
		$this->config = $config;
		$this->currentUrl = $currentUrl;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		return new BannerView($this->config, $this);
	}

	public function loggedMemberUsername()
	{
		$memberId = $this->session->loggedMemberId();
		$loggedMemberUsername = null;
		if ($memberId)
		{
			try
			{
				$loggedMemberUsername = $this->memberDao->findById($memberId)->username();
			}
			catch (\Exception $ex)
			{
			}
		}
		return $loggedMemberUsername;
	}

	public function currentUrl()
	{
		return $this->currentUrl;
	}

	public function indexUrl()
	{
		return (new IndexRouter($this->config->rootUrl()))->url();
	}

	public function optionsUrl()
	{
		return (new OptionsRouter($this->config->rootUrl()))->url();
	}

	public function loginUrl()
	{
		return (new LoginRouter($this->config->rootUrl()))->url();
	}

	public function logoutUrl()
	{
		return (new LogoutRouter($this->config->rootUrl()))->url();
	}
}
