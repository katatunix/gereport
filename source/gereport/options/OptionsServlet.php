<?php

namespace gereport\options;

use gereport\Component;
use gereport\MainServlet;

class OptionsServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new OptionsComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
