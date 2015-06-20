<?php

namespace gereport\login;

use gereport\MainServlet;
use gereport\View;

class LoginServlet extends MainServlet
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return (new LoginComponent($this->httpRequest, $this->config, $this->session, $this->daoFactory))->view();
	}
}
