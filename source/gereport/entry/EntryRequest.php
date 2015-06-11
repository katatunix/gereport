<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 6:21 PM
 */

namespace gereport\entry;


use gereport\BaseRequest;

class EntryRequest extends BaseRequest
{
	/**
	 * @var EntryRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function entryId()
	{
		return $this->httpRequest->valueGet($this->router->entryIdKey());
	}
}
