<?php

namespace gereport\entry\add;

use gereport\Component;
use gereport\MainServlet;

class AddEntryServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new AddEntryComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
