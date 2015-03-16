<?php

namespace gereport\handler;

__import('view/DelReportView');
__import('controller/DelReportController');

use gereport\controller\DelReportController;
use gereport\view\DelReportView;

class DelReportHandler extends Handler
{
	/**
	 * @return void
	 */
	public function handle()
	{
		$view = new DelReportView($this->toolbox->request, $this->toolbox->urlSource, $this->toolbox->htmlDir);
		$controller = new DelReportController($view, $this->toolbox);
		$controller->process();
	}
}
