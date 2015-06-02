<?php

namespace gereport\post;

class AddPostRouter
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
