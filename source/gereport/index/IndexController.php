<?php

namespace gereport\index;

use gereport\decorator\MainLayoutController;
use gereport\View;

class IndexController extends MainLayoutController
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return $this->factory->view()->index();
	}
}
