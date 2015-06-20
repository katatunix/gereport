<?php

namespace gereport\report\delete;

use gereport\Servlet;

class DeleteReportServlet extends Servlet
{
	public function process()
	{
		(new DeleteReportComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory))->view();
	}
}
