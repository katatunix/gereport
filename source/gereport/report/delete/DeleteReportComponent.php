<?php

namespace gereport\report\delete;

use gereport\Component;
use gereport\Redirector;
use gereport\router\DeleteReportRouter;
use gereport\View;

class DeleteReportComponent extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return null;

		$error = false;
		$message = 'The report has been deleted OK';
		$request = new DeleteReportRequest($this->httpRequest, new DeleteReportRouter($this->config->rootUrl()));
		try
		{
			$this->daoFactory->report()->delete($request->reportId());
		}
		catch (\Exception $ex)
		{
			$error = true;
			$message = $ex->getMessage();
		}

		$this->session->saveMessage($message, $error);
		(new Redirector( $request->nextUrl() ))->redirect();
		return null;
	}
}
