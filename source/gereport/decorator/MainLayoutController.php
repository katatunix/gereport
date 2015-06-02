<?php

namespace gereport\decorator;

__import('gereport/Controller');
__import('gereport/index/IndexRouter');
__import('gereport/mysqldomain/MySqlMemberDao');
__import('gereport/mysqldomain/MySqlProjectDao');
__import('gereport/Controller');
__import('gereport/decorator/BannerView');
__import('gereport/decorator/FooterView');
__import('gereport/decorator/SidebarView');
__import('gereport/decorator/MainLayoutView');

use gereport\Controller;
use gereport\index\IndexRouter;
use gereport\mysqldomain\MySqlMemberDao;
use gereport\mysqldomain\MySqlProjectDao;
use gereport\View;

abstract class MainLayoutController extends Controller
{
	/**
	 * @return View
	 */
	protected abstract function createContentView();

	public function process()
	{
		$this->init();

		$contentView = $this->createContentView();
		$bannerView = $this->createBannerView();
		$footerView = $this->createFooterView();
		$sidebarView = $this->createSidebarView();

		(new MainLayoutView($this->config, $contentView, $bannerView, $footerView, $sidebarView))->show();
	}

	private function createBannerView()
	{
		$username = null;

		if ($this->session->hasLogged())
		{
			$memberDao = new MySqlMemberDao();
			$member = $memberDao->findById( $this->session->loggedMemberId() );
			$username = $member->username();
		}

		return new BannerView($this->config, $username);
	}

	private function createFooterView()
	{
		return new FooterView($this->config);
	}

	private function createSidebarView()
	{
		$projectDao = new MySqlProjectDao();
		$projects = $projectDao->findByAll();
		$arr = array();
		foreach ($projects as $project)
		{
			$arr[] = array('id' => $project->id(), 'name' => $project->name());
		}

		return new SidebarView($this->config, $arr);
	}

	protected function goIndex()
	{
		$this->redirector->go($this->config->rootUrl() . IndexRouter::ROUTER);
	}
}
