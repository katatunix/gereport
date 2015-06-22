<?php

namespace gereport\entry\delete;

use gereport\BaseRequest;
use gereport\router\DeleteEntryRouter;

class DeleteEntryRequest extends BaseRequest
{
	/**
	 * @var DeleteEntryRouter
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
