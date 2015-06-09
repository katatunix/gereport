<?php

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
