<?php

namespace gereport;

abstract class View
{
	/**
	 * @var Config
	 */
	protected $config;
	protected $title;

	public function __construct($config, $title = null)
	{
		$this->config = $config;
		$this->title = $title;
	}

	public abstract function render();

	public function title()
	{
		return $this->title;
	}
}
