<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/19/2015
 * Time: 11:56 PM
 */

namespace gereport\index;

use gereport\MainServlet;
use gereport\View;

class IndexServlet extends MainServlet
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return new IndexView($this->config);
	}
}
