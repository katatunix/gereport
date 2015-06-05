<?php

namespace gereport\post;

use gereport\HttpRequest;

class AddPostRequest
{
	/**
	 * @var AddPostRouter
	 */
	private $router;

	/**
	 * @var Request
	 */
	private $request;

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
		return $this->request->valuePost($this->router->projectIdKey());
	}
}
