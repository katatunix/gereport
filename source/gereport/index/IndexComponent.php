<?php

namespace gereport\index;

use gereport\Component;
use gereport\View;

class IndexComponent extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		return new IndexView($this->config);
	}
}
