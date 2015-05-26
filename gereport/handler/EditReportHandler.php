<?php

namespace gereport\handler;

__import('handler/MainLayoutHandler');
__import('controller/EditReportController');

use gereport\controller\EditReportController;

class EditReportHandler extends MainLayoutHandler
{
	public function getContentView()
	{
		return (new EditReportController($this->toolbox))->process();
	}
}
