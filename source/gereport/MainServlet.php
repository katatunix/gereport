<?php

namespace gereport;

use gereport\banner\BannerComponent;
use gereport\sidebar\SidebarComponent;

abstract class MainServlet extends Servlet
{
	public function process()
	{
		// Content
		$contentComponent = $this->createContentComponent();
		$contentView = $contentComponent->view();

		// Banner
		$bannerComponent = new BannerComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
		$bannerView = $bannerComponent->view();

		// Sidebar
		$sidebarComponent = new SidebarComponent(
			$this->httpRequest, $this->session,
			$this->config, $this->daoFactory, $contentComponent->categoryUrl()
		);
		$sidebarView = $sidebarComponent->view();

		// Main
		$mainView = new MainView($this->config, $contentView, $bannerView, $sidebarView);
		$mainView->render();
	}

	/**
	 * @return Component
	 */
	protected abstract function createContentComponent();
}
