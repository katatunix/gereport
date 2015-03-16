<?php

namespace gereport\request;

class Request
{
	const RT = 'rt';

	private $isPostMethod;
	private $dataPost;
	private $dataGet;
	private $uri;

	public function __construct($isPostMethod, $dataPost, $dataGet, $uri)
	{
		$this->isPostMethod = $isPostMethod;
		$this->dataPost = $dataPost;
		$this->dataGet = $dataGet;
		$this->uri = $uri;
	}

	public function getRouter()
	{
		return isset($this->dataGet[self::RT]) ? $this->dataGet[self::RT] : '';
	}

	public function isPostMethod()
	{
		return $this->isPostMethod;
	}

	public function getDataPost($key)
	{
		return isset($this->dataPost[$key]) ? $this->removeSlashes($this->dataPost[$key]) : null;
	}

	public function getDataGet($key)
	{
		return isset($this->dataGet[$key]) ? $this->removeSlashes($this->dataGet[$key]) : null;
	}

	public function getData($key)
	{
		return $this->isPostMethod() ? $this->getDataPost($key) : $this->getDataGet($key);
	}

	public function getUri()
	{
		return $this->uri;
	}

	private function removeSlashes($str)
	{
		if (!is_string($str)) return $str;
		if (get_magic_quotes_gpc())
		{
			return stripslashes($str);
		}
		return $str;
	}
}
