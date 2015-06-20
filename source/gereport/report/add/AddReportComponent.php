<?php

namespace gereport\report\add;

use gereport\Component;
use gereport\Redirector;
use gereport\router\AddReportRouter;
use gereport\View;

class AddReportComponent extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return null;

		$message = 'The report has been submitted OK';
		$isError = false;

		$request = new AddReportRequest($this->httpRequest, new AddReportRouter($this->config->rootUrl()));
		try
		{
			$this->daoFactory->report()->insert(
				$request->content(),
				$request->projectId(),
				$request->dateFor(),
				$this->session->loggedMemberId()
			);
		}
		catch (\Exception $ex)
		{
			$message = $ex->getMessage();
			$isError = true;
		}

		$this->session->saveMessage($message, $isError);
		( new Redirector($request->nextUrl()) )->redirect();
		return null;
	}
}
