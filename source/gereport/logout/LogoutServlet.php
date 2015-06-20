<?php

namespace gereport\logout;

use gereport\Redirector;
use gereport\router\IndexRouter;
use gereport\Servlet;

class LogoutServlet extends Servlet
{
	public function process()
	{
		$this->session->clearLogin();
		$indexUrl = (new IndexRouter($this->config->rootUrl()))->url();
		(new Redirector($indexUrl))->redirect();
	}
}
