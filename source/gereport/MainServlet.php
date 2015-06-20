<?php

namespace gereport;

use gereport\banner\BannerComponent;
use gereport\sidebar\SidebarComponent;

abstract class MainServlet extends Servlet
{
	public function process()
	{
		// Content
		$contentView = $this->createContentView();

		// Banner
		$bannerComponent = new BannerComponent($this->httpRequest, $this->config, $this->session, $this->daoFactory);
		$bannerView = $bannerComponent->view();

		// Sidebar
		$sidebarComponent = new SidebarComponent($this->httpRequest, $this->config, $this->session, $this->daoFactory);
		$sidebarView = $sidebarComponent->view();

		// Main
		$mainView = new MainView($this->config, $contentView, $bannerView, $sidebarView);
		$mainView->render();
	}

	/**
	 * @return View
	 */
	protected abstract function createContentView();
}
