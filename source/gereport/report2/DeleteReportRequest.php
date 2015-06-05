<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 6:08 PM
 */

namespace gereport\report;


use gereport\BaseRequest;

class DeleteReportRequest extends BaseRequest
{
	/**
	 * @var DeleteReportRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function reportId()
	{
		return $this->httpRequest->valueGet($this->router->reportIdKey());
	}

	public function nextUrl()
	{
		return $this->httpRequest->valueGet($this->router->nextUrlKey());
	}
}
