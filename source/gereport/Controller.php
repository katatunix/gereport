<?php

namespace gereport;

__import('gereport/Config');
__import('gereport/Session');
__import('gereport/Redirector');

abstract class Controller
{
	/**
	 * @var Config
	 */
	protected $config;

	/**
	 * @var Session
	 */
	protected $session;

	/**
	 * @var Redirector
	 */
	protected $redirector;

	protected function init()
	{
		$this->config = new Config();
		$this->session = new Session();
		$this->redirector = new Redirector();
	}

	public abstract function process();
}
