<?php

namespace gereport\index;

use gereport\Router;

class IndexRouter extends Router
{
	const ROUTER = '';

	public function redirect()
	{
		$this->redirect($this->rootUrl . self::ROUTER);
	}
}
