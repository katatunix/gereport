<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/20/2015
 * Time: 6:29 PM
 */

namespace gereport\report;


use gereport\MainServlet;
use gereport\View;

class ReportServlet extends MainServlet
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		return (new ReportComponent($this->httpRequest, $this->config, $this->session, $this->daoFactory))->view();
	}
}
