<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/2/2015
 * Time: 11:31 PM
 */

namespace gereport;


class Router
{
	protected $rootUrl;

	public function __construct($rootUrl)
	{
		$this->rootUrl = $rootUrl;
	}
}
