<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/20/2015
 * Time: 6:07 PM
 */

namespace gereport\error;


use gereport\MainServlet;
use gereport\View;

class Error404Servlet extends MainServlet
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return new Error404View($this->config);
	}
}
