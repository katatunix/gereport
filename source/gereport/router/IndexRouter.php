<?php

namespace gereport\router;

use gereport\Router;

class IndexRouter extends Router
{
	const ROUTER = '';

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
