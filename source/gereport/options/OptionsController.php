<?php

namespace gereport\options;

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
			return $this->factory->view()->error403();
		}
		return $this->factory->view()->options( $this->factory->router()->cpass()->url() );
	}
}
