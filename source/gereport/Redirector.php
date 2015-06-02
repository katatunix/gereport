<?php

namespace gereport;

class Redirector
{
	public function go($url)
	{
		header('LOCATION: ' . $url);
	}
}
