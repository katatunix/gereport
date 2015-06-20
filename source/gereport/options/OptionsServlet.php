<?php

namespace gereport\options;

use gereport\MainServlet;
use gereport\View;

class OptionsServlet extends MainServlet
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return (new OptionsComponent($this->httpRequest, $this->config, $this->session, $this->daoFactory))->view();
	}
}
