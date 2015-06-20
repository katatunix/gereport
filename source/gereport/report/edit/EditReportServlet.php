<?php

namespace gereport\report\edit;

use gereport\Component;
use gereport\MainServlet;

class EditReportServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new EditReportComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
