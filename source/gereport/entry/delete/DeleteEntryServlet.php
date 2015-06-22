<?php

namespace gereport\entry\delete;

use gereport\Component;
use gereport\MainServlet;

class DeleteEntryServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new DeleteEntryComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
