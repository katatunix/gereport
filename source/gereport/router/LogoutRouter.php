<?php

namespace gereport\router;

use gereport\Router;

class LogoutRouter extends Router
{
	const ROUTER = 'logout';

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
