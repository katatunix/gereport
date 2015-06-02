<?php

namespace gereport;

abstract class Controller
{
	/**
	 * @var Session
	 */
	protected $session;

	/**
	 * @var Factory
	 */
	protected $factory;

	public function __construct($session, $factory)
	{
		$this->session = $session;
		$this->factory = $factory;
	}

	/**
	 * @return void
	 */
	public abstract function process();
}
