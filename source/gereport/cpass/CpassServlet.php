<?php

namespace gereport\cpass;

use gereport\Component;
use gereport\MainServlet;

class CpassServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new CpassComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
