<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 2:37 PM
 */

namespace gereport\options;


use gereport\Router;

class OptionsRouter extends Router
{
	const ROUTER = 'options';

	public function url()
	{
		return $this->rootUrl . self::ROUTER;
	}
}
