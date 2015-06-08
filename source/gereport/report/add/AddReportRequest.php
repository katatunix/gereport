<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/5/2015
 * Time: 10:11 PM
 */

namespace gereport\report\add;

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
