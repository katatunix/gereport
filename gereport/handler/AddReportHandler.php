<?php

namespace gereport\handler;

__import('view/AddReportView');
__import('controller/AddReportController');

use gereport\controller\AddReportController;
use gereport\view\AddReportView;

class AddReportHandler extends Handler
{
	/**
	 * @return void
	 */
	public function handle()
	{
		$view = new AddReportView($this->toolbox->request, $this->toolbox->urlSource, $this->toolbox->htmlDir);
		$controller = new AddReportController($view, $this->toolbox);
		$controller->process();
	}
}
