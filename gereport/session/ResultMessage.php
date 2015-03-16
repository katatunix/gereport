<?php

namespace gereport\session;

class ResultMessage
{
	public $content;
	public $isError;

	public function __construct($content, $isError)
	{
		$this->content = $content;
		$this->isError = $isError;
	}
}
