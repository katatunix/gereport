<?php

namespace gereport\handler;

__import('handler/MainLayoutHandler');
__import('controller/LoginController');

use gereport\controller\LoginController;

class LoginHandler extends MainLayoutHandler
{
	public function handle()
	{
		if ($this->toolbox->session->isLogged())
		{
			$this->toolbox->redirector->toIndex();
		}
		else
		{
			parent::handle();
		}
	}

	public function getContentView()
	{
		return (new LoginController($this->toolbox))->process();
	}
}
