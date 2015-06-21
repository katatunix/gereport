<?php

namespace gereport\entry;

use gereport\Component;
use gereport\domain\Entry;
use gereport\error\Error403View;
use gereport\router\EditEntryRouter;
use gereport\router\EntryRouter;
use gereport\View;

class EntryComponent extends Component implements EntryViewInfo
{
	/**
	 * @var Entry
	 */
	private $entry;
	/**
	 * @return View
	 */
	public function view()
	{
		$router = new EntryRouter($this->config->rootUrl());
		$request = new EntryRequest($this->httpRequest, $router);
		$this->entry = $this->daoFactory->entry()->findById($request->entryId());
		if (!$this->entry)
		{
			return new Error403View($this->config);
		}
		return new EntryView($this->config, $this->entry->title(), $this);
	}

	public function title()
	{
		return $this->entry->title();
	}

	public function content()
	{
		return $this->entry->content();
	}

	public function authorUsername()
	{
		return $this->entry->authorUsername();
	}

	public function createdTime()
	{
		return $this->entry->createdTime();
	}

	public function lastEditorUsername()
	{
		return $this->entry->lastEditorUsername();
	}

	public function lastEditedTime()
	{
		return $this->entry->lastEditedTime();
	}

	public function editEntryUrl()
	{
		return (new EditEntryRouter($this->config->rootUrl()))->url($this->entry->id());
	}

	public function canBeManuplated()
	{
		if (!$this->session->hasLogged()) return false;
		return $this->entry->canBeManuplatedByMember($this->session->loggedMemberId());
	}
}
