<?php

namespace gereport\decorator;

use gereport\View;

class Error403View extends View
{
	public function __construct($htmlDirPath, $htmlDirUrl)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl, 'Error 403');
	}

	protected function htmlFileName()
	{
		return 'Error403Html.php';
	}
}
