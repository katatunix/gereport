<?php

namespace gereport\cpass;

use gereport\MainServlet;
use gereport\View;

class CpassServlet extends MainServlet
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return (new CpassComponent($this->httpRequest, $this->config, $this->session, $this->daoFactory))->view();
	}
}
