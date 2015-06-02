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

	public function show()
	{
		require $this->config->htmlDirPath() . $this->htmlFileName();
	}

	public function title()
	{
		return $this->title;
	}

	protected abstract function htmlFileName();
}
