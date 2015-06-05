<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 5:36 PM
 */

namespace gereport\report;


use gereport\BaseRequest;

class AddReportRequest extends BaseRequest
{
	/**
	 * @var AddReportRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function content()
	{
		return $this->httpRequest->valuePost($this->router->contentKey());
	}

	public function projectId()
	{
		return $this->httpRequest->valuePost($this->router->projectIdKey());
	}

	public function dateFor()
	{
		return $this->httpRequest->valuePost($this->router->dateForKey());
	}

	public function nextUrl()
	{
		return $this->httpRequest->valuePost($this->router->nextUrlKey());
	}
}
