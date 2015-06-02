<?php

namespace gereport;

class Request
{
	private $get;
	private $post;
	private $isPostMethod;
	private $url;

	public function __construct()
	{
		$this->get = $_GET;
		$this->post = $_POST;
		$this->isPostMethod = $_SERVER['REQUEST_METHOD'] == 'POST';
		$this->url = $_SERVER['REQUEST_URI'];
	}

	public function url()
	{
		return $this->url;
	}

	public function isPostMethod()
	{
		return $this->isPostMethod;
	}

	public function valuePost($key)
	{
		return isset($this->post[$key]) ? $this->removeSlashes($this->post[$key]) : null;
	}

	public function valueGet($key)
	{
		return isset($this->get[$key]) ? $this->removeSlashes($this->get[$key]) : null;
	}

	public function value($key)
	{
		return $this->isPostMethod() ? $this->valuePost($key) : $this->valueGet($key);
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
