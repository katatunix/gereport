<?php

namespace gereport;

use gereport\banner\BannerController;
use gereport\cpass\CpassController;
use gereport\cpass\CpassRequest;
use gereport\cpass\CpassRouter;
use gereport\entry\add\AddEntryController;
use gereport\entry\add\AddEntryRequest;
use gereport\entry\add\AddEntryRouter;
use gereport\entry\edit\EditEntryController;
use gereport\entry\edit\EditEntryRequest;
use gereport\entry\edit\EditEntryRouter;
use gereport\entry\EntryController;
use gereport\entry\EntryRequest;
use gereport\entry\EntryRouter;
use gereport\error\Error404View;
use gereport\foptions\FoptionsController;
use gereport\foptions\FoptionsRequest;
use gereport\foptions\FoptionsRouter;
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
use gereport\report\delete\DeleteReportController;
use gereport\report\delete\DeleteReportRequest;
use gereport\report\delete\DeleteReportRouter;
use gereport\report\edit\EditReportController;
use gereport\report\edit\EditReportRequest;
use gereport\report\edit\EditReportRouter;
use gereport\report\ReportController;
use gereport\report\ReportRequest;
use gereport\report\ReportRouter;
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
			$this->handleIndex($httpRequest);
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
			$this->handleOptions($httpRequest);
		}
		else if ($rt == CpassRouter::ROUTER)
		{
			$this->handleCpass($httpRequest);
		}
		else if ($rt == ReportRouter::ROUTER)
		{
			$this->handleReport($httpRequest);
		}
		else if ($rt == AddReportRouter::ROUTER)
		{
			$this->handleAddReport($httpRequest);
		}
		else if ($rt == EditReportRouter::ROUTER)
		{
			$this->handleEditReport($httpRequest);
		}
		else if ($rt == DeleteReportRouter::ROUTER)
		{
			$this->handleDeleteReport($httpRequest);
		}
		else if ($rt == EntryRouter::ROUTER)
		{
			$this->handleEntry($httpRequest);
		}
		else if ($rt == AddEntryRouter::ROUTER)
		{
			$this->handleAddEntry($httpRequest);
		}
		else if ($rt == EditEntryRouter::ROUTER)
		{
			$this->handleEditEntry($httpRequest);
		}
		else if ($rt == FoptionsRouter::ROUTER)
		{
			$this->handleFoptions($httpRequest);
		}
		else
		{
			$this->handleNotFound($httpRequest);
		}
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleIndex($httpRequest)
	{
		$this->renderMainView(new IndexView($this->config), $httpRequest->url());
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleNotFound($httpRequest)
	{
		$this->renderMainView(new Error404View($this->config), $httpRequest->url());
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleLogin($httpRequest)
	{
		$router = new LoginRouter($this->config->rootUrl());
		$request = new LoginRequest($httpRequest, $router);
		$controller = new LoginController($request, $this->session,
			$this->daoFactory->member(), $this->config, $router);

		$view = $controller->process();
		$this->renderMainView($view, $httpRequest->url());
	}

	private function handleLogout()
	{
		(new LogoutController($this->session, $this->config))->process();
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleOptions($httpRequest)
	{
		$r = $this->config->rootUrl();
		$this->renderMainView(
			(new OptionsController(
				$this->session,
				$this->config,
				(new CpassRouter($r))->url()
			))->process(),
			$httpRequest->url()
		);
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleCpass($httpRequest)
	{
		$router = new CpassRouter($this->config->rootUrl());
		$request = new CpassRequest($httpRequest, $router);
		$memberDao = $this->daoFactory->member();
		$controller = new CpassController($request, $this->session, $memberDao, $this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view, $httpRequest->url());
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleReport($httpRequest)
	{
		$router = new ReportRouter($this->config->rootUrl());
		$request = new ReportRequest($httpRequest, $router);
		$controller = new ReportController($request, $this->session, $this->daoFactory, $this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view, $httpRequest->url());
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleAddReport($httpRequest)
	{
		$router = new AddReportRouter($this->config->rootUrl());
		$request = new AddReportRequest($httpRequest, $router);
		$controller = new AddReportController($request, $this->session, $this->daoFactory->report(), $this->config);
		$controller->process();
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleEditReport($httpRequest)
	{
		$router = new EditReportRouter($this->config->rootUrl());
		$request = new EditReportRequest($httpRequest, $router);
		$controller = new EditReportController($request, $this->session,
			$this->daoFactory->report(), $this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view, $httpRequest->url());
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleDeleteReport($httpRequest)
	{
		$router = new DeleteReportRouter($this->config->rootUrl());
		$request = new DeleteReportRequest($httpRequest, $router);
		$controller = new DeleteReportController($request, $this->session, $this->daoFactory->report());
		$controller->process();
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleEntry($httpRequest)
	{
		$router = new EntryRouter($this->config->rootUrl());
		$request = new EntryRequest($httpRequest, $router);
		$controller = new EntryController($request, $this->session, $this->daoFactory->entry(), $this->config);
		$view = $controller->process();

		$this->renderMainView($view, $httpRequest->url());
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleAddEntry($httpRequest)
	{
		$router = new AddEntryRouter($this->config->rootUrl());
		$request = new AddEntryRequest($httpRequest, $router);
		$controller = new AddEntryController($request, $this->session,
			$this->daoFactory->entry(), $this->daoFactory->project(),
			$this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view, $httpRequest->url());
	}

	/**
	 * @param $httpRequest HttpRequest
	 */
	private function handleEditEntry($httpRequest)
	{
		$router = new EditEntryRouter($this->config->rootUrl());
		$request = new EditEntryRequest($httpRequest, $router);
		$controller = new EditEntryController($request, $this->session,
			$this->daoFactory->entry(), $this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view, $httpRequest->url());
	}

	private function handleFoptions($httpRequest)
	{
		$router = new FoptionsRouter($this->config->rootUrl());
		$request = new FoptionsRequest($httpRequest, $router);
		$controller = new FoptionsController($request, $this->session,
			$this->daoFactory->folder(), $this->config, $router);
		$view = $controller->process();

		$this->renderMainView($view, $httpRequest->url());
	}

	private function renderMainView($contentView, $currentUrl)
	{
		// Banner
		$bannerController = new BannerController($this->session,
			$this->daoFactory->member(), $this->config, $currentUrl);

		$bannerView = $bannerController->process();

		// Sidebar
		$r = $this->config->rootUrl();
		$sidebarController = new SidebarController($this->session, $this->daoFactory->project(), $this->config,
			new EntryRouter($r), new ReportRouter($r), $currentUrl
		);
		$sidebarView = $sidebarController->process();

		// Main
		$mainView = new MainView($this->config, $contentView, $bannerView, $sidebarView);
		$mainView->render();
	}
}
