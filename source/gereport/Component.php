<?php

namespace gereport;

abstract class Component
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

	/**
	 * @return View
	 */
	public abstract function view();
}
