<?php

namespace gereport\view;

class Error403View extends View
{
	public function __construct($urlSource, $htmlDir)
	{
		parent::__construct($urlSource, $htmlDir);
		$this->setTitle('Error 403');
	}

	public function show()
	{
		require $this->htmlDir . 'Error403Html.php';
	}
}
