<?php

namespace gereport\post;

use gereport\View;

class AddPostView extends View
{
	private $success;
	private $message;
	private $router;

	public function __construct($config, $success, $message, $router)
	{
		parent::__construct($config, 'Add a new post');
		$this->success = $success;
		$this->message = $message;
		$this->router = $router;
	}

	protected function htmlFileName()
	{
		return 'AddPostHtml.php';
	}
}
