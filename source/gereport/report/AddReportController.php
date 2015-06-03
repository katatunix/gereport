<?php

namespace gereport\controller;

use gereport\Controller;
use gereport\DatetimeUtils;
use gereport\report\AddReportRequest;
use gereport\View;

class AddReportController extends Controller
{
	/**
	 * @var AddReportRequest
	 */
	private $request;

	public function __construct($request, $session, $factory)
	{
		parent::__construct($session, $factory);
		$this->request = $request;
	}

	/**
	 * @return void
	 */
	public function process()
	{
		if (!$this->session->hasLogged())
		{
			$this->factory->router()->index()->redirect();
		}

		$error = false;
		$message = null;

		$content = $this->request->content();
		if (!$content)
		{
			$error = true;
			$message = 'Report content must not be empty';
		}

		if (!$error)
		{
			try
			{
				$this->factory->dao()->report()->add($content, $this->request->projectId(), $this->request->dateFor(),
					DatetimeUtils::getCurDatetime(), $this->session->loggedMemberId());
				$message = 'Report was submitted OK';
			}
			catch (\Exception $ex)
			{
				$error = true;
				$message = $ex->getMessage();
			}
		}

		$this->session->saveMessage($message, $error);
		$this->factory->router()->redirectTo($this->request->nextUrl());
	}
}
