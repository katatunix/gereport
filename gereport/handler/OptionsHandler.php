<?php

namespace gereport\handler;

__import('handler/MainLayoutHandler');
__import('controller/OptionsController');

use gereport\controller\OptionsController;

class OptionsHandler extends MainLayoutHandler
{
	public function getContentView()
	{
		return (new OptionsController($this->toolbox))->process();
	}
}
