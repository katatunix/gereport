<?php

namespace gereport\entry;

use gereport\BaseRequest;
use gereport\HttpRequest;

class AddEntryRequest extends BaseRequest
{
	/**
	 * @var AddEntryRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function title()
	{
		return $this->httpRequest->valuePost($this->router->titleKey());
	}

	public function content()
	{
		return $this->httpRequest->valuePost($this->router->contentKey());
	}

	public function projectId()
	{
		return $this->httpRequest->valueGet($this->router->projectIdKey());
	}
}
