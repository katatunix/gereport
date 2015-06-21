<?php

namespace gereport;

class Main
{
	private $servletMap = array(
		router\IndexRouter::ROUTER		=> 'index\\Index',
		router\LoginRouter::ROUTER		=> 'login\\Login',
		router\LogoutRouter::ROUTER		=> 'logout\\Logout',
		router\OptionsRouter::ROUTER	=> 'options\\Options',
		router\CpassRouter::ROUTER		=> 'cpass\\Cpass',
		router\ReportRouter::ROUTER		=> 'report\\Report',
		router\AddReportRouter::ROUTER	=> 'report\\add\\AddReport',
		router\EditReportRouter::ROUTER	=> 'report\\edit\\EditReport',
		router\DeleteReportRouter::ROUTER	=> 'report\\delete\\DeleteReport',
		router\FoptionsRouter::ROUTER	=> 'foptions\\Foptions'
	);

	public function main()
	{
		$httpRequest = new HttpRequest($_GET, $_POST, $_SERVER['REQUEST_METHOD'] == 'POST', $_SERVER['REQUEST_URI']);
		$router = $httpRequest->valueGet('rt');
		if (!$router) $router = router\IndexRouter::ROUTER;

		$servletName = null;
		foreach ($this->servletMap as $rt => $svl)
		{
			if ($router == $rt)
			{
				$servletName = $svl;
				break;
			}
		}

		if (!$servletName) $servletName = 'error\\Error404';
		$servletName = '\\gereport\\' . $servletName . 'Servlet';
		$servlet = new $servletName(
			$httpRequest,
			new Session(),
			new Config(),
			new DaoFactory('localhost', 'root', '', 'gereport')
		);
		$servlet->process();
	}
}
