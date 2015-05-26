<?php

namespace gereport\handler;

__import('handler/MainLayoutHandler');
__import('controller/ChangePasswordController');

use gereport\controller\ChangePasswordController;

class ChangePasswordHandler extends MainLayoutHandler
{
	public function getContentView()
	{
		return (new ChangePasswordController($this->toolbox))->process();
	}
}
