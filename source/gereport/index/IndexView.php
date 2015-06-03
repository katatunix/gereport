<?php

namespace gereport\index;

use gereport\View;

class IndexView extends View
{
	public function __construct($htmlDirPath, $htmlDirUrl)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl, 'Welcome');
	}

	protected function htmlFileName()
	{
		return 'IndexHtml.php';
	}
}
