<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 1:59 PM
 */

namespace gereport\projecthome;


use gereport\BaseRequest;

class ProjectHomeRequest extends BaseRequest
{
	/**
	 * @var ProjectHomeRouter
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
}
