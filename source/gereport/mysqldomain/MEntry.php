<?php

namespace gereport\mysqldomain;

use gereport\domain\Entry;

class MEntry extends MBO implements Entry
{
	public function title()
	{
		return $this->retrieve('entry', 'title');
	}

	public function content()
	{
		return $this->retrieve('entry', 'content');
	}

	public function authorUsername()
	{
		$authorId = $this->retrieve('entry', 'authorId');
		return (new MMember($this->link, $authorId))->username();
	}

	public function createdTime()
	{
		return $this->retrieve('entry', 'createdTime');
	}

	public function lastEditorUsername()
	{
		$editorId = $this->retrieve('entry', 'lastEditorId');
		return (new MMember($this->link, $editorId))->username();
	}

	public function lastEditedTime()
	{
		return $this->retrieve('entry', 'lastEditedTime');
	}

	public function projectId()
	{
		return $this->retrieve('entry', 'projectId');
	}

	public function projectName()
	{
		$projectId = $this->projectId();
		if ($projectId)
		{
			return (new MProject($this->link, $projectId))->name();
		}
		throw new \Exception('This is an overall entry');
	}

	public function update($title, $content, $editorId)
	{
		// TODO: Implement update() method.
	}
}
