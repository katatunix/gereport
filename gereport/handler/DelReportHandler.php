<?php

namespace gereport\handler;

__import('controller/DelReportController');

use gereport\controller\DelReportController;

class DelReportHandler extends Handler
{
	/**
	 * @return void
	 */
	public function handle()
	{
		(new DelReportController($this->toolbox))->process();
	}
}
