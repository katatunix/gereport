<?php

namespace gereport\controller;

use gereport\Controller;
use gereport\report\DeleteReportRequest;

class DeleteReportController extends Controller
{
	/**
	 * @var DeleteReportRequest
	 */
	private $request;

	public function __construct($request, $session, $factory)
	{
		parent::__construct($session, $factory);
		$this->request = $request;
	}

	public function process()
	{
		if (!$this->session->hasLogged())
		{
			$this->factory->router()->index()->redirect();
		}

		$error = false;
		$message = null;
		try
		{
			$this->factory->dao()->report()->delete($this->request->reportId());
			$message = 'Report was deleted OK';
		}
		catch (\Exception $ex)
		{
			$error = true;
			$message = $ex->getMessage();
		}

		$this->session->saveMessage($message, $error);
		$this->factory->router()->redirectTo($this->request->nextUrl());
	}
}
