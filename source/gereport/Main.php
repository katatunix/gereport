<?php

namespace gereport;

use gereport\banner\BannerProcessor;
use gereport\banner\BannerResponse;
use gereport\cpass\CpassRouter;
use gereport\error\Error404View;
use gereport\footer\FooterView;
use gereport\index\IndexRouter;
use gereport\index\IndexView;
use gereport\login\LoginProcessor;
use gereport\login\LoginRequest;
use gereport\login\LoginResponse;
use gereport\login\LoginRouter;
use gereport\logout\LogoutResponse;
use gereport\logout\LogoutRouter;
use gereport\options\OptionsRouter;
use gereport\options\OptionsView;
use gereport\sidebar\SidebarProcessor;
use gereport\sidebar\SidebarResponse;

class Main
{
	/**
	 * @var Session
	 */
	private $session;
	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var DaoFactory
	 */
	private $daoFactory;

	public function main()
	{
		$this->session = new Session();
		$this->config = new Config();
		$this->daoFactory = new DaoFactory('localhost', 'root', '', 'gereport');

		$httpRequest = new HttpRequest($_GET, $_POST, $_SERVER['REQUEST_METHOD'] == 'POST', $_SERVER['REQUEST_URI']);
		$rt = $httpRequest->valueGet('rt');

		if (!$rt)
		{
			$this->handleIndex();
		}
		else if ($rt == LoginRouter::ROUTER)
		{
			$this->handleLogin($httpRequest);
		}
		else if ($rt == LogoutRouter::ROUTER)
		{
			$this->handleLogout();
		}
		else if ($rt == OptionsRouter::ROUTER)
		{
			$this->handleOptions();
		}
		else
		{
			$this->handle4NotFound();
		}
	}

	private function handleIndex()
	{
		$this->renderMainView(new IndexView($this->config));
	}

	private function handle4NotFound()
	{
		$this->renderMainView(new Error404View($this->config));
	}

	private function handleLogin($httpRequest)
	{
		$loginRouter = new LoginRouter($this->config->rootUrl());
		$loginRequest = new LoginRequest($httpRequest, $loginRouter);
		$loginProcessor = new LoginProcessor($loginRequest, $this->session, $this->daoFactory->member());
		$indexRedirector = new Redirector(
			(new IndexRouter(
				$this->config->rootUrl()
			))->url()
		);
		$loginResponse = new LoginResponse($loginProcessor, $this->session, $indexRedirector, $this->config, $loginRouter);
		$loginView = $loginResponse->execute();

		$this->renderMainView($loginView);
	}

	private function handleLogout()
	{
		$r = $this->config->rootUrl();
		(new LogoutResponse(
			$this->session,
			new Redirector(
				(new IndexRouter($r))->url()
			)
		))->execute();
	}

	private function handleOptions()
	{
		$r = $this->config->rootUrl();
		$this->renderMainView(
			new OptionsView(
				$this->config,
				(new CpassRouter($r))->url()
			)
		);
	}

	private function renderMainView($contentView)
	{
		//
		$bannerProcessor = new BannerProcessor($this->session, $this->daoFactory->member());
		$r = $this->config->rootUrl();
		$bannerResponse = new BannerResponse($bannerProcessor, $this->config,
			(new IndexRouter($r))->url(),
			(new optionsRouter($r))->url(),
			(new LoginRouter($r))->url(),
			(new LogoutRouter($r))->url()
		);
		$bannerView = $bannerResponse->execute();

		//
		$sidebarProcessor = new SidebarProcessor($this->daoFactory->project());
		$sidebarResponse = new SidebarResponse($sidebarProcessor, new ReportRouter($r), $this->config);
		$sidebarView = $sidebarResponse->execute();

		//
		$footerView = new FooterView($this->config);

		//
		$mainView = new MainView($this->config, $contentView, $bannerView, $sidebarView, $footerView);
		$mainView->render();
	}
}
