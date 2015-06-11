<?php

namespace gereport\mysqldomain;

use gereport\domain\Entry;

class MEntry implements Entry
{

	/**
	 * @var \mysqli
	 */
	private $link;
	private $id;
	/**
	 * @var FieldRetriever
	 */
	private $retriever;

	public function __construct($link, $id)
	{
		$this->link = $link;
		$this->id = $id;
		$this->retriever = new FieldRetriever();
	}

	public function id()
	{
		return $this->id;
	}

	public function title()
	{
		return $this->retriever->retrieve($this->link, 'entry', 'title', 'id', $this->id);
	}

	public function content()
	{
		return $this->retriever->retrieve($this->link, 'entry', 'content', 'id', $this->id);
	}

	public function authorUsername()
	{
		$authorId = $this->retriever->retrieve($this->link, 'entry', 'authorId', 'id', $this->id);
		return (new MMember($this->link, $authorId))->username();
	}

	public function createdTime()
	{
		$authorId = $this->retriever->retrieve($this->link, 'entry', 'createdTime', 'id', $this->id);
	}

	public function lastEditorUsername()
	{
		$editorId = $this->retriever->retrieve($this->link, 'entry', 'lastEditorId', 'id', $this->id);
		return (new MMember($this->link, $editorId))->username();
	}

	public function lastEditedTime()
	{
		$authorId = $this->retriever->retrieve($this->link, 'entry', 'lastEditedTime', 'id', $this->id);
	}
}
