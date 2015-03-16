<?php

namespace gereport\handler;

__import('handler/Handler');
__import('controller/Redirector');
__import('view/UrlSource');

use gereport\controller\Redirector;
use gereport\view\UrlSource;

class RootHandler extends Handler implements Redirector, UrlSource
{
	const INDEX = '';
	const LOGIN = 'login';
	const LOGOUT = 'logout';
	const REPORT = 'report';
	const ADD_REPORT = 'report/add';
	const OPTIONS = 'options';
	const CHANGE_PASSWORD = 'cpass';

	private $map = array
	(
		self::INDEX => 'IndexHandler',
		self::LOGIN => 'LoginHandler',
		self::LOGOUT => 'LogoutHandler',
		self::REPORT => 'ReportHandler',
		self::ADD_REPORT => 'AddReportHandler',
		self::OPTIONS => 'OptionsHandler',
		self::CHANGE_PASSWORD => 'ChangePasswordHandler'
	);

	private $rootUrl;

	public function __construct($rootUrl, $toolbox)
	{
		parent::__construct($toolbox);
		$this->rootUrl = $rootUrl;
	}

	public function handle()
	{
		$handlerClass = null;
		if ($this->toolbox->database->isConnected())
		{
			foreach ($this->map as $router => $class)
			{
				if ($router == $this->toolbox->request->getRouter())
				{
					$handlerClass = $class;
					break;
				}
			}
		}
		if (!$handlerClass)
		{
			$handlerClass = 'Error404Handler';
		}

		__import('handler/' . $handlerClass);
		$handlerClass = '\\gereport\\handler\\' . $handlerClass;
		(new $handlerClass($this->toolbox))->handle();
	}

	public function toIndex()
	{
		$this->redirect($this->getIndexUrl());
	}

	public function toLogout()
	{
		$this->redirect($this->getLogoutUrl());
	}

	public function to($url)
	{
		$this->redirect($url);
	}

	private function redirect($url)
	{
		header('LOCATION: ' . $url);
		exit;
	}

	public function getHtmlUrl()
	{
		return $this->rootUrl . 'html/';
	}

	public function getIndexUrl()
	{
		return $this->rootUrl;
	}

	public function getLoginUrl()
	{
		return $this->rootUrl . self::LOGIN;
	}

	public function getLogoutUrl()
	{
		return $this->rootUrl . self::LOGOUT;
	}

	public function getReportUrl()
	{
		return $this->rootUrl . self::REPORT;
	}

	public function getAddReportUrl()
	{
		return $this->rootUrl . self::ADD_REPORT;
	}

	public function getOptionsUrl()
	{
		return $this->rootUrl . self::OPTIONS;
	}

	public function getChangePasswordUrl()
	{
		return $this->rootUrl . self::CHANGE_PASSWORD;
	}
}
