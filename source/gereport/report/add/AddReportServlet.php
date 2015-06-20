<?php

namespace gereport\report\add;

use gereport\Servlet;

class AddReportServlet extends Servlet
{
	public function process()
	{
		(new AddReportComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory))->view();
	}
}
