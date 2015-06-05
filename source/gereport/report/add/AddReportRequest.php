<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/5/2015
 * Time: 10:11 PM
 */

namespace gereport\report\add;


use gereport\BaseRequest;
use gereport\HttpRequest;

class AddReportRequest extends BaseRequest
{
	/**
	 * @var HttpRequest
	 */
	private $httpRequest;
	/**
	 * @var AddReportRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		$this->httpRequest = $httpRequest;
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
