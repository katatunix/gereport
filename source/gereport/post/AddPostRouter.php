<?php

namespace gereport\post;

use gereport\Router;

class AddPostRouter extends Router
{
	const ROUTER = 'post/add';

	public function titleKey()
	{
		return 'title';
	}

	public function contentKey()
	{
		return 'content';
	}

	public function projectIdKey()
	{
		return 'pid';
	}
}
