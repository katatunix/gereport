<?php

namespace gereport;

abstract class Servlet
{
	/**
	 * @var HttpRequest
	 */
	protected $httpRequest;

	/**
	 * @var Session
	 */
	protected $session;

	/**
	 * @var Config
	 */
	protected $config;

	/**
	 * @var DaoFactory
	 */
	protected $daoFactory;

	public function __construct($httpRequest, $session, $config, $daoFactory)
	{
		$this->httpRequest = $httpRequest;
		$this->session = $session;
		$this->config = $config;
		$this->daoFactory = $daoFactory;
	}

	public abstract function process();
}
