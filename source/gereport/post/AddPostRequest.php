<?php

namespace gereport\post;

use gereport\Request;

class AddPostRequest extends Request
{
	/**
	 * @var AddPostRouter
	 */
	private $router;

	public function __construct($router)
	{
		parent::__construct();
		$this->router = $router;
	}

	public function title()
	{
		return $this->valuePost($this->router->titleKey());
	}

	public function content()
	{
		return $this->valuePost($this->router->contentKey());
	}

	public function projectId()
	{
		return $this->valuePost($this->router->projectIdKey());
	}
}
