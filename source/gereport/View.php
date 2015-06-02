<?php

namespace gereport;

abstract class View
{
	protected $htmlDirPath, $htmlDirUrl;

	protected $title;

	public function __construct($htmlDirPath, $htmlDirUrl, $title = null)
	{
		$this->htmlDirPath = $htmlDirPath;
		$this->htmlDirUrl = $htmlDirUrl;
		$this->title = $title;
	}

	public function show()
	{
		require $this->htmlDirPath . $this->htmlFileName();
	}

	public function title()
	{
		return $this->title;
	}

	protected abstract function htmlFileName();
}
