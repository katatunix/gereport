<?php

namespace gereport;


class Router
{
	protected $rootUrl;

	public function __construct($rootUrl)
	{
		$this->rootUrl = $rootUrl;
	}
}
