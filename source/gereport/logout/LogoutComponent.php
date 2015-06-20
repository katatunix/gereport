<?php

namespace gereport\logout;

use gereport\Component;
use gereport\Redirector;
use gereport\router\IndexRouter;
use gereport\View;

class LogoutComponent extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		$this->session->clearLogin();
		$indexUrl = (new IndexRouter($this->config->rootUrl()))->url();
		(new Redirector($indexUrl))->redirect();
	}
}
