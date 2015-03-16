<?php

namespace gereport\handler;

__import('handler/MainLayoutHandler');
__import('view/EditReportView');
__import('controller/EditReportController');

use gereport\view\EditReportView;
use gereport\view\View;
use gereport\controller\EditReportController;

class EditReportHandler extends MainLayoutHandler
{
	/**
	 * @return View
	 */
	public function getContentView()
	{
		$view = new EditReportView($this->toolbox->request, $this->toolbox->urlSource, $this->toolbox->htmlDir);
		$controller = new EditReportController($view, $this->toolbox);
		return $controller->process();
	}
}
