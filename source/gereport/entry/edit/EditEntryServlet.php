<?php

namespace gereport\entry\edit;

use gereport\Component;
use gereport\MainServlet;

class EditEntryServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new EditEntryComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
