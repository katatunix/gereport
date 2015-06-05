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
	private $url;

	public function __construct($url)
	{
		$this->url = $url;
	}

	public function redirect()
	{
		header('LOCATION: ' . $this->url);
	}
}
