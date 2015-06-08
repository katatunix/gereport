<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 6:26 PM
 */

namespace gereport\report\edit;


use gereport\BaseRequest;

class EditReportRequest extends BaseRequest
{
	/**
	 * @var EditReportRouter
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

	public function content()
	{
		return $this->httpRequest->valuePost($this->router->contentKey());
	}
}
