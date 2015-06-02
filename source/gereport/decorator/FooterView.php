<?php

namespace gereport\decorator;

__import('gereport/View');

use gereport\View;

class FooterView extends View
{
	protected function htmlFileName()
	{
		return 'FooterHtml.php';
	}
}
