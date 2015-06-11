<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:38 PM
 */

namespace gereport\entry\edit;

use gereport\Config;
use gereport\Controller;
use gereport\domain\Entry;
use gereport\domain\EntryDao;
use gereport\entry\Breadcrumb;
use gereport\error\Error403View;
use gereport\Session;
use gereport\View;

class EditEntryController implements Controller, EditEntryViewInfo
{
	/**
	 * @var EditEntryRequest
	 */
	private $request;
	/**
	 * @var Session
	 */
	private $session;
	/**
	 * @var EntryDao
	 */
	private $entryDao;
	/**
	 * @var Config
	 */
	private $config;
	/**
	 * @var EditEntryRouter
	 */
	private $editEntryRouter;

	private $entryContent;
	private $entryTitle;

	private $projectId, $projectName;

	private $message;
	private $success;

	public function __construct($request, $session, $entryDao, $config, $editEntryRouter)
	{
		$this->request = $request;
		$this->session = $session;
		$this->entryDao = $entryDao;
		$this->config = $config;
		$this->editEntryRouter = $editEntryRouter;
	}

	private function error()
	{
		return new Error403View($this->config);
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged()) return $this->error();

		$entry = $this->entryDao->findById($this->request->entryId());
		if (!$entry) return $this->error();

		$this->message = null;
		$this->success = true;

		$this->projectId = $entry->projectId();
		if ($this->projectId)
		{
			try { $this->projectName = $entry->projectName(); }
			catch (\Exception $ex) { return $this->error(); }
		}

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
		$this->entryContent = $this->request->content();
		$this->entryTitle = $this->request->title();
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

	public function breadcrumb()
	{
		return (new Breadcrumb())->make(
			$this->projectId, $this->projectName, $this->config->rootUrl()
		);
	}
}
