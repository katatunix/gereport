<?php

namespace gereport\decorator;

use gereport\Controller;
use gereport\View;

class Error404Controller extends MainLayoutController
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return new Error404View($this->config);
	}
}
