<?php

namespace gereport\logout;

use gereport\Servlet;

class LogoutServlet extends Servlet
{
	public function process()
	{
		(new LogoutComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory))->view();
	}
}
