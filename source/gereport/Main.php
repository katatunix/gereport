<?php

namespace gereport;

use gereport\banner\BannerValidator;
use gereport\banner\BannerResponse;
use gereport\cpass\CpassValidator;
use gereport\cpass\CpassRequest;
use gereport\cpass\CpassResponse;
use gereport\cpass\CpassRouter;
use gereport\error\Error404View;
use gereport\footer\FooterView;
use gereport\index\IndexRouter;
use gereport\index\IndexView;
use gereport\login\LoginValidator;
use gereport\login\LoginRequest;
use gereport\login\LoginResponse;
use gereport\login\LoginRouter;
use gereport\logout\LogoutResponse;
use gereport\logout\LogoutRouter;
use gereport\options\OptionsResponse;
use gereport\options\OptionsRouter;
use gereport\sidebar\SidebarValidator;
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
		else if ($rt == CpassRouter::ROUTER)
		{
			$this->handleCpass($httpRequest);
		}
		else
		{
			$this->handleNotFound();
		}
	}

	private function handleIndex()
	{
		$this->renderMainView(new IndexView($this->config));
	}

	private function handleNotFound()
	{
		$this->renderMainView(new Error404View($this->config));
	}

	private function handleLogin($httpRequest)
	{
		$router = new LoginRouter($this->config->rootUrl());
		$request = new LoginRequest($httpRequest, $router);
		$validator = new LoginValidator($request, $this->session, $this->daoFactory->member());
		$indexRedirector = new Redirector(
			(new IndexRouter(
				$this->config->rootUrl()
			))->url()
		);
		$response = new LoginResponse($validator, $this->session, $indexRedirector, $this->config, $router);
		$view = $response->execute();

		$this->renderMainView($view);
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
			(new OptionsResponse(
				$this->session,
				$this->config,
				(new CpassRouter($r))->url()
			))->execute()
		);
	}

	private function handleCpass($httpRequest)
	{
		$router = new CpassRouter($this->config->rootUrl());
		$request = new CpassRequest($httpRequest, $router);
		$memberDao = $this->daoFactory->member();
		$validator = new CpassValidator($request, $this->session, $memberDao);
		$response = new CpassResponse($validator, $memberDao, $this->config, $router);
		$view = $response->execute();

		$this->renderMainView($view);
	}

	private function renderMainView($contentView)
	{
		// Banner
		$bannerValidator = new BannerValidator($this->session, $this->daoFactory->member());
		$r = $this->config->rootUrl();
		$bannerResponse = new BannerResponse($bannerValidator, $this->config,
			(new IndexRouter($r))->url(),
			(new optionsRouter($r))->url(),
			(new LoginRouter($r))->url(),
			(new LogoutRouter($r))->url()
		);
		$bannerView = $bannerResponse->execute();

		// Sidebar
		$sidebarValidator = new SidebarValidator($this->daoFactory->project());
		$sidebarResponse = new SidebarResponse($sidebarValidator, new ReportRouter($r), $this->config);
		$sidebarView = $sidebarResponse->execute();

		// Footer
		$footerView = new FooterView($this->config);

		// Main
		$mainView = new MainView($this->config, $contentView, $bannerView, $sidebarView, $footerView);
		$mainView->render();
	}
}
