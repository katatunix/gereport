<?php

namespace gereport\handler;

__import('controller/AddReportController');

use gereport\controller\AddReportController;

class AddReportHandler extends Handler
{
	/**
	 * @return void
	 */
	public function handle()
	{
		(new AddReportController($this->toolbox))->process();
	}
}
