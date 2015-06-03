<?php

namespace gereport\authen;

use gereport\Controller;

class LogoutController extends Controller
{
	public function process()
	{
		$this->session->clearLogin();
		$this->factory->router()->index()->redirect();
	}
}
