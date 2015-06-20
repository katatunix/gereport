<?php

namespace gereport\options;

use gereport\Component;
use gereport\error\Error403View;
use gereport\router\CpassRouter;
use gereport\View;

class OptionsComponent extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return new Error403View($this->config);
		$cpassUrl = (new CpassRouter($this->config->rootUrl()))->url();
		return new OptionsView($this->config, $cpassUrl);
	}
}
