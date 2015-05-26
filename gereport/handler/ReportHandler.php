<?php

namespace gereport\handler;

__import('handler/MainLayoutHandler');
__import('controller/ReportController');

use gereport\controller\ReportController;

class ReportHandler extends MainLayoutHandler
{
	public function getContentView()
	{
		return (new ReportController($this->toolbox))->process();
	}
}
