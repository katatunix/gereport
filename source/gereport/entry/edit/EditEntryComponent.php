<?php

namespace gereport\entry\edit;

use gereport\Component;
use gereport\domain\Entry;
use gereport\error\Error404View;
use gereport\router\EditEntryRouter;
use gereport\router\EntryRouter;
use gereport\View;

class EditEntryComponent extends Component implements EditEntryViewInfo
{
	private $entryTitle;
	private $entryContent;

	private $message;
	private $success;

	/**
	 * @var EditEntryRouter
	 */
	private $editEntryRouter;
	/**
	 * @var EditEntryRequest
	 */
	private $request;

	public function __construct($httpRequest, $session, $config, $daoFactory)
	{
		parent::__construct($httpRequest, $session, $config, $daoFactory);

		$this->editEntryRouter = new EditEntryRouter($this->config->rootUrl());
		$this->request = new EditEntryRequest($this->httpRequest, $this->editEntryRouter);
	}

	private function error()
	{
		return new Error404View($this->config);
	}

	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return $this->error();

		try
		{
			$entry = $this->daoFactory->entry()->findById($this->request->entryId());
		}
		catch (\Exception $ex)
		{
			return $this->error();
		}

		$this->message = null;
		$this->success = true;

		if (!$this->request->isPostMethod())
		{
			$this->handleGET($entry);
		}
		else
		{
			$this->handlePOST($entry);
		}

		return new EditEntryView($this->config, $this);
	}

	/**
	 * @param $entry Entry
	 */
	private function handleGET($entry)
	{
		try
		{
			$this->entryContent = $entry->content();
			$this->entryTitle = $entry->title();

			// Because a message may come from the AddEntry page
			if ($this->session->hasMessage())
			{
				$msgObj = $this->session->message();
				$this->message = $msgObj->content;
				$this->success = !$msgObj->isError;
				$this->session->clearMessage();
			}
		}
		catch (\Exception $ex)
		{
			$this->message = $ex->getMessage();
			$this->success = false;
		}
	}

	/**
	 * @param $entry Entry
	 */
	public function handlePOST($entry)
	{
		$this->entryTitle = $this->request->title();
		$this->entryContent = $this->request->content();
		try
		{
			$entry->update($this->entryTitle, $this->entryContent, $this->session->loggedMemberId());
			$this->message = 'The entry has been saved OK';
		}
		catch (\Exception $ex)
		{
			$this->message = $ex->getMessage();
			$this->success = false;
		}
	}

	public function title()
	{
		return $this->entryTitle;
	}

	public function content()
	{
		return $this->entryContent;
	}

	public function titleKey()
	{
		return $this->editEntryRouter->titleKey();
	}

	public function contentKey()
	{
		return $this->editEntryRouter->contentKey();
	}

	public function message()
	{
		return $this->message;
	}

	public function success()
	{
		return $this->success;
	}

	public function entryUrl()
	{
		return (new EntryRouter($this->config->rootUrl()))->url($this->request->entryId());
	}

	public function categoryUrl()
	{
		return $this->entryUrl();
	}
}
