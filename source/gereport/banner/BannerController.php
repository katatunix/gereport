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

	private $loggedMemberUsername;

	public function __construct($session, $memberDao, $config)
	{
		$this->session = $session;
		$this->memberDao = $memberDao;
		$this->config = $config;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		$memberId = $this->session->loggedMemberId();
		if ($memberId)
		{
			try
			{
				$this->loggedMemberUsername = $this->memberDao->findById($memberId)->username();
			}
			catch (\Exception $ex)
			{
				$this->loggedMemberUsername = null;
			}
		}
		return new BannerView($this->config, $this);
	}

	public function loggedMemberUsername()
	{
		return $this->loggedMemberUsername;
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
