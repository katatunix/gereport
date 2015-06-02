<?php

namespace gereport\domainproxy;

__import('gereport/domain/Post');
__import('gereport/domainimpl/PostImpl');
__import('gereport/domainproxy/Proxy');

use gereport\domain\Post;
use gereport\domainimpl\PostImpl;

class PostProxy extends Proxy implements Post
{
	public function __construct($id, $database)
	{
		parent::__construct($id, $database);
	}

	public function getTitle()
	{
		return $this->createPostImpl()->getTitle();
	}

	public function getContent()
	{
		return $this->createPostImpl()->getContent();
	}

	public function getAuthorUsername()
	{
		return $this->createPostImpl()->getAuthorUsername();
	}

	public function getCreatedTime()
	{
		return $this->createPostImpl()->getCreatedTime();
	}

	public function getLastEditorUsername()
	{
		return $this->createPostImpl()->getLastEditorUsername();
	}

	public function getLastEditedTime()
	{
		return $this->createPostImpl()->getLastEditedTime();
	}

	private function createPostImpl()
	{
		$data = $this->database->findPost($this->id);
		return new PostImpl(
			$data['title'],
			$data['content'],
			new MemberProxy($data['authorId'], $this->database),
			$data['createdTime'],
			new MemberProxy($data['lastEditorId'], $this->database),
			$data['lastEditedTime']
		);
	}
}
