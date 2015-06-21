<?php

namespace gereport\entry;

use gereport\BaseRequest;
use gereport\router\EntryRouter;

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
