<?php

namespace gereport\options;

use gereport\View;

class OptionsView extends View
{
	protected $cpassUrl;

	public function __construct($htmlDirPath, $htmlDirUrl, $cpassUrl)
	{
		parent::__construct($htmlDirPath, $htmlDirUrl, 'Options');
		$this->cpassUrl = $cpassUrl;
	}

	protected function htmlFileName()
	{
		return 'OptionsHtml.php';
	}
}
