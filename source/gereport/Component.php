<?php

namespace gereport;

abstract class Component
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

	public function __construct($httpRequest, $config, $session, $daoFactory)
	{
		$this->httpRequest = $httpRequest;
		$this->config = $config;
		$this->session = $session;
		$this->daoFactory = $daoFactory;
	}

	/**
	 * @return View
	 */
	public abstract function view();
}
