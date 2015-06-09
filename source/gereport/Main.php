<?php

namespace gereport;

use gereport\banner\BannerController;
use gereport\cpass\CpassController;
use gereport\cpass\CpassRequest;
use gereport\cpass\CpassRouter;
use gereport\error\Error404View;
use gereport\footer\FooterView;
use gereport\index\IndexView;
use gereport\login\LoginController;
use gereport\login\LoginRequest;
use gereport\login\LoginRouter;
use gereport\logout\LogoutController;
use gereport\logout\LogoutRouter;
use gereport\options\OptionsController;
use gereport\options\OptionsRouter;
use gereport\report\add\AddReportRequest;
use gereport\report\add\AddReportRouter;
use gereport\report\add\AddReportController;
use gereport\report\edit\EditReportController;
use gereport\report\edit\EditReportRequest;
use gereport\report\edit\EditReportRouter;
use gereport\sidebar\SidebarController;

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
		else if ($rt == AddReportRouter::ROUTER)
		{
			$this->handleAddReport($httpRequest);
		}
		else if ($rt == EditReportRouter::ROUTER)
		{
			$this->handleEditReport($httpRequest);
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
		$controller = new LoginController($request, $this->session,
			$this->daoFactory->member(), $this->config, $router);

		$view = $controller->process();
		$this->renderMainView($view);
	}

	private function handleLogout()
	{
		(new LogoutController($this->session, $this->config))->process();
	}

	private function handleOptions()
	{
		$r = $this->config->rootUrl();
		$this->renderMainView(
			(new OptionsController(
				$this->session,
				$this->config,
				(new CpassRouter($r))->url()
			))->process()
		);
	}

	private function handleCpass($httpRequest)
	{
		$router = new CpassRouter($this->config->rootUrl());
		$request = new CpassRequest($httpRequest, $router);
		$memberDao = $this->daoFactory->member();
		$controller = new CpassController($request, $this->session, $memberDao, $this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view);
	}

	private function handleAddReport($httpRequest)
	{
		$router = new AddReportRouter($this->config->rootUrl());
		$request = new AddReportRequest($httpRequest, $router);
		$controller = new AddReportController($request, $this->session, $this->daoFactory->report(), $this->config);
		$controller->process();
	}

	private function handleEditReport($httpRequest)
	{
		$router = new EditReportRouter($this->config->rootUrl());
		$request = new EditReportRequest($httpRequest, $router);
		$controller = new EditReportController($request, $this->session, $this->daoFactory->report(), $this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view);
	}

	private function renderMainView($contentView)
	{
		// Banner
		$bannerController = new BannerController($this->session, $this->daoFactory->member(), $this->config);

		$bannerView = $bannerController->process();

		// Sidebar
		$sidebarController = new SidebarController($this->daoFactory->project(), $this->config);
		$sidebarView = $sidebarController->process();

		// Footer
		$footerView = new FooterView($this->config);

		// Main
		$mainView = new MainView($this->config, $contentView, $bannerView, $sidebarView, $footerView);
		$mainView->render();
	}
}
