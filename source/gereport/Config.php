<?php

namespace gereport;

class Config
{
	public function rootDir()
	{
		return __ROOT_DIR;
	}

	public function rootUrl()
	{
		return __ROOT_URL;
	}

	public function htmlDirPath()
	{
		return __ROOT_DIR . 'html/';
	}

	public function htmlDirUrl()
	{
		return __ROOT_URL . 'html/';
	}
}
