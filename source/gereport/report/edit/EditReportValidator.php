<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/6/2015
 * Time: 11:55 AM
 */

namespace gereport\report\edit;

use gereport\DatetimeUtils;
use gereport\Session;
use gereport\Controller;

class EditReportController implements Controller
{
	/**
	 * @var EditReportRequest
	 */
	private $request;

	/**
	 * @var Session
	 */
	private $session;

	public function __construct($request, $session)
	{
		$this->request = $request;
		$this->session = $session;
	}

	/**
	 * @throws \Exception
	 * @return void
	 */
	public function process()
	{
		if ($this->accessDenied())
		{
			return;
		}
		if (!$this->request->content())
		{
			throw new \Exception('Report content is empty');
		}
	}

	public function accessDenied()
	{
		return !$this->session->hasLogged();
	}

	/**
	 * @return EditReportRequest
	 */
	public function request()
	{
		return $this->request;
	}

	public function datetime()
	{
		return DatetimeUtils::getCurDatetime();
	}
}
