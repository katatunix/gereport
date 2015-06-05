<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/5/2015
 * Time: 10:29 PM
 */

namespace gereport\report\add;


use gereport\DatetimeUtils;
use gereport\Validator;
use gereport\report\AddReportRequest;
use gereport\Session;

class AddReportValidator implements Validator
{
	/**
	 * @var AddReportRequest
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
	public function validate()
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
	 * @return AddReportRequest
	 */
	public function request()
	{
		return $this->request;
	}

	public function memberId()
	{
		return $this->session->loggedMemberId();
	}

	public function datetimeAdd()
	{
		return DatetimeUtils::getCurDatetime();
	}
}
