<?php

namespace gereport\banner;

use gereport\Component;
use gereport\router\LoginRouter;
use gereport\router\LogoutRouter;
use gereport\router\OptionsRouter;
use gereport\View;

class BannerComponent extends Component implements BannerViewInfo
{
	/**
	 * @return View
	 */
	public function view()
	{
		return new BannerView($this->config, $this);
	}

	public function loggedMemberUsername()
	{
		$memberId = $this->session->loggedMemberId();
		$loggedMemberUsername = null;
		if ($memberId)
		{
			try
			{
				$loggedMemberUsername = $this->daoFactory->member()->findById($memberId)->username();
			}
			catch (\Exception $ex)
			{
			}
		}
		return $loggedMemberUsername;
	}

	public function currentUrl()
	{
		return $this->httpRequest->url();
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
