<?php

namespace gereport\handler;

__import('handler/MainLayoutHandler');
__import('controller/IndexController');

use gereport\controller\IndexController;

class IndexHandler extends MainLayoutHandler
{
	public function getContentView()
	{
		return (new IndexController($this->toolbox))->process();
	}
}
