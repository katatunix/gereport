<?php

namespace gereport\handler;

__import('view/MainLayoutView');

__import('controller/BannerController');
__import('controller/FooterController');
__import('controller/SidebarController');

use gereport\controller\BannerController;
use gereport\controller\FooterController;
use gereport\controller\SidebarController;

use gereport\view\View;
use gereport\view\MainLayoutView;

abstract class MainLayoutHandler extends Handler
{
	public function handle()
	{
		$bannerView = (new BannerController($this->toolbox))->process();
		$footerView = (new FooterController($this->toolbox))->process();
		$sidebarView = (new SidebarController($this->toolbox))->process();

		(new MainLayoutView($this->toolbox->urlSource, $this->toolbox->htmlDir))
			->setBannerView($bannerView)
			->setFooterView($footerView)
			->setSidebarView($sidebarView)
			->setContentView($this->getContentView())
			->show();
	}

	/**
	 * @return View
	 */
	public abstract function getContentView();
}
