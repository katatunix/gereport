<?php

namespace gereport;

class HttpRequest
{
	private $get;
	private $post;
	private $isPostMethod;
	private $url;

	public function __construct($dataGet, $dataPost, $isPostMethod, $url)
	{
		$this->get = $dataGet;
		$this->post = $dataPost;
		$this->isPostMethod = $isPostMethod;
		$this->url = $url;
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
