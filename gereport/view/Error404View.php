<?php

namespace gereport\view;

class Error404View extends View
{
	public function __construct($urlSource, $htmlDir)
	{
		parent::__construct($urlSource, $htmlDir);
		$this->setTitle('Error 404');
	}

	public function show()
	{
		require $this->htmlDir . 'Error404Html.php';
	}
}
