<?php

namespace gereport\authen;

__import('gereport/Controller');
__import('gereport/index/IndexRouter');

use gereport\Controller;
use gereport\index\IndexRouter;

class LogoutController extends Controller
{
	public function process()
	{
		$this->init();

		$this->session->clearLogin();
		$this->goIndex();
	}

	protected function goIndex()
	{
		$this->redirector->go($this->config->rootUrl() . IndexRouter::ROUTER);
	}
}
