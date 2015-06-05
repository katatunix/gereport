<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/2/2015
 * Time: 11:52 PM
 */

namespace gereport;


class BaseRequest
{
	/**
	 * @var HttpRequest
	 */
	protected $httpRequest;

	public function __construct($httpRequest)
	{
		$this->httpRequest = $httpRequest;
	}

	public function isPostMethod()
	{
		return $this->httpRequest->isPostMethod();
	}
}
