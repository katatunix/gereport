<?php

namespace gereport\entry;

use gereport\BaseRequest;
use gereport\HttpRequest;

class AddEntryRequest extends BaseRequest
{
	/**
	 * @var HttpRequest
	 */
	private $request;

	/**
	 * @var AddEntryRouter
	 */
	private $router;

	public function __construct($request, $router)
	{
		$this->request = $request;
		$this->router = $router;
	}

	public function title()
	{
		return $this->request->valuePost($this->router->titleKey());
	}

	public function content()
	{
		return $this->request->valuePost($this->router->contentKey());
	}

	public function projectId()
	{
		return $this->request->valueGet($this->router->projectIdKey());
	}
}
