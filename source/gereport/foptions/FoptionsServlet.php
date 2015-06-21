<?php

namespace gereport\foptions;

use gereport\Component;
use gereport\MainServlet;

class FoptionsServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new FoptionsComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
