<?php

namespace gereport\login;

use gereport\Component;
use gereport\MainServlet;

class LoginServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new LoginComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
