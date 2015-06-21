<?php

namespace gereport\logout;

use gereport\Component;
use gereport\Redirector;
use gereport\View;

class LogoutComponent extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		$this->session->clearLogin();
		(new Redirector($this->config->rootUrl()))->redirect();
		return null;
	}
}
