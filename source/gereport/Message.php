<?php

namespace gereport;

class Message
{
	public $content;
	public $isError;

	public function __construct($content, $isError)
	{
		$this->content = $content;
		$this->isError = $isError;
	}
}
