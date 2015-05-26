<?php

namespace gereport\controller;

__import('controller/controller');
__import('view/IndexView');

use gereport\view\IndexView;

class IndexController extends Controller
{
	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		$view = new IndexView($this->toolbox->urlSource, $this->toolbox->htmlDir);
		$view->setTitle('Welcome');
		return $view;
	}
}
