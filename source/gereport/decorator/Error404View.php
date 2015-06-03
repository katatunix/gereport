<?php

namespace gereport\decorator;

use gereport\View;

class Error404View extends View
{
	public function __construct($htmlDirPath, $htmlDirUrl)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl, 'Error 404');
	}

	protected function htmlFileName()
	{
		return 'Error404Html.php';
	}
}
