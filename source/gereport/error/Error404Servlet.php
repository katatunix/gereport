<?php

namespace gereport\error;

use gereport\Component;
use gereport\MainServlet;

class Error404Servlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new Error404Component($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
