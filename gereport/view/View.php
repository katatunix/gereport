<?php

namespace gereport\view;

abstract class View
{
	/**
	 * @var UrlSource
	 */
	protected $urlSource;

	protected $htmlDir;

	protected $title;

	public function __construct($urlSource, $htmlDir)
	{
		$this->urlSource = $urlSource;
		$this->htmlDir = $htmlDir;
	}

	public function setTitle($val)
	{
		$this->title = $val;
	}

	public abstract function show();
}
