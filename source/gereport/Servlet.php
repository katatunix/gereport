<?php

namespace gereport;

abstract class Servlet
{
	/**
	 * @var HttpRequest
	 */
	protected $httpRequest;

	/**
	 * @var Config
	 */
	protected $config;

	/**
	 * @var Session
	 */
	protected $session;

	/**
	 * @var DaoFactory
	 */
	protected $daoFactory;

	public function __construct($httpRequest)
	{
		$this->httpRequest = $httpRequest;

		$this->config = new Config();
		$this->session = new Session();
		$this->daoFactory = new DaoFactory('localhost', 'root', '', 'gereport');
	}

	public abstract function process();
}
