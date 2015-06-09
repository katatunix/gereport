<?php

namespace gereport\report;

use gereport\BaseRequest;

class ReportRequest extends BaseRequest
{
	/**
	 * @var ReportRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function projectId()
	{
		return $this->httpRequest->valueGet($this->router->projectIdKey());
	}

	public function date()
	{
		return $this->httpRequest->valueGet($this->router->dateKey());
	}

	public function currentUrl()
	{
		return $this->httpRequest->url();
	}
}
