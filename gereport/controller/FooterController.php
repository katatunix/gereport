<?php

namespace gereport\controller;

__import('controller/controller');
__import('view/FooterView');

use gereport\view\FooterView;

class FooterController extends Controller
{
	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		return new FooterView($this->toolbox->urlSource, $this->toolbox->htmlDir);
	}
}
