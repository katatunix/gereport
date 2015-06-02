<?php

namespace gereport\decorator;

__import('gereport/Controller');

use gereport\Controller;
use gereport\View;

abstract class MainLayoutController extends Controller
{
	/**
	 * @return View
	 */
	protected abstract function createContentView();

	public function process()
	{
		$content = $this->createContentView();
		$banner = $this->createBannerView();
		$footer = $this->createFooterView();
		$sidebar = $this->createSidebarView();

		$this->factory->view()->mainLayout($banner, $footer, $sidebar, $content)->show();
	}

	private function createBannerView()
	{
		$username = null;

		if ($this->session->hasLogged())
		{
			$member = $this->factory->dao()->member()->findById( $this->session->loggedMemberId() );
			$username = $member->username();
		}

		return $this->factory->view()->banner($username);
	}

	private function createFooterView()
	{
		return $this->factory->view()->footer();
	}

	private function createSidebarView()
	{
		$projects = $this->factory->dao()->project()->findByAll();
		$arr = array();
		foreach ($projects as $project)
		{
			$arr[] = array('id' => $project->id(), 'name' => $project->name());
		}

		return $this->factory->view()->sidebar($arr);
	}
}
