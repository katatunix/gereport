<?php

namespace gereport\options;

use gereport\decorator\Error403View;
use gereport\decorator\MainLayoutController;
use gereport\View;

class OptionsController extends MainLayoutController
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		if (!$this->session->hasLogged())
		{
			return new Error403View($this->config);
		}
		return new OptionsView($this->config);
	}
}
