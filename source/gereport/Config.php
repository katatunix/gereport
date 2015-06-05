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

	public function resDirPath()
	{
		return __ROOT_DIR . 'res/';
	}

	public function resDirUrl()
	{
		return __ROOT_URL . 'res/';
	}
}
