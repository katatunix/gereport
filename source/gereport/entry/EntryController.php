<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 6:22 PM
 */

namespace gereport\entry;


use gereport\Config;
use gereport\Controller;
use gereport\domain\EntryDao;
use gereport\entry\edit\EditEntryRouter;
use gereport\error\Error403View;
use gereport\Session;
use gereport\View;

class EntryController implements Controller, EntryViewInfo
{
	/**
	 * @var EntryRequest
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

	private $projectId;
	private $projectName;

	private $entryContent;

	private $entryAuthor;
	private $entryCreatedTime;
	private $entryEditor;
	private $entryEditedTime;

	private $canBeManupaled;

	private function error()
	{
		return new Error403View($this->config);
	}

	public function __construct($request, $session, $entryDao, $config)
	{
		$this->request = $request;
		$this->session = $session;
		$this->entryDao = $entryDao;
		$this->config = $config;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		$entry = $this->entryDao->findById($this->request->entryId());
		if (!$entry) return $this->error();

		$this->projectId = $entry->projectId();
		if ($this->projectId)
		{
			try { $this->projectName = $entry->projectName(); }
			catch (\Exception $ex) { return $this->error(); }
		}

		try
		{
			$entryTitle = $entry->title();
			$this->entryContent = $entry->content();

			$this->entryAuthor = $entry->authorUsername();
			$this->entryCreatedTime = $entry->createdTime();

			$this->entryEditor = $entry->lastEditorUsername();
			$this->entryEditedTime = $entry->lastEditedTime();

			$this->canBeManupaled = $this->session->hasLogged() ?
				$entry->canBeManuplatedByMember($this->session->loggedMemberId()) :
				false;
		}
		catch (\Exception $ex)
		{
			return $this->error();
		}

		return new EntryView($this->config, $entryTitle, $this);
	}

	public function content()
	{
		return $this->entryContent;
	}

	public function breadcrumb()
	{
		return (new Breadcrumb())->make(
			$this->projectId, $this->projectName, $this->config->rootUrl()
		);
	}

	public function author()
	{
		return $this->entryAuthor;
	}

	public function createdTime()
	{
		return $this->entryCreatedTime;
	}

	public function editor()
	{
		return $this->entryEditor;
	}

	public function editedTime()
	{
		return $this->entryEditedTime;
	}

	public function canBeManupaled()
	{
		return $this->canBeManupaled;
	}

	public function editUrl()
	{
		return (new EditEntryRouter($this->config->rootUrl()))->url($this->request->entryId());
	}
}
