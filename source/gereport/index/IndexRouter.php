<?php

namespace gereport\index;

use gereport\Router;

class IndexRouter extends Router
{
	const ROUTER = '';

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}