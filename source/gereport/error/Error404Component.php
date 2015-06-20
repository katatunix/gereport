<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/20/2015
 * Time: 8:56 PM
 */

namespace gereport\error;


use gereport\Component;
use gereport\View;

class Error404Component extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		return new Error404View($this->config);
	}
}
