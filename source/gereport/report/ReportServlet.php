<?php

namespace gereport\report;

use gereport\Component;
use gereport\MainServlet;

class ReportServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new ReportComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
