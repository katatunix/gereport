<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 5:56 PM
 */

namespace gereport;


class Redirector
{
	public function redirect($url)
	{
		header('LOCATION: ' . $url);
	}
}
