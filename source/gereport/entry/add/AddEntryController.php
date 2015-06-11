<?php

namespace gereport\entry\add;

use gereport\Config;
use gereport\Controller;
use gereport\domain\EntryDao;
use gereport\domain\ProjectDao;
use gereport\entry\Breadcrumb;
use gereport\entry\edit\EditEntryRouter;
use gereport\error\Error403View;
use gereport\Redirector;
use gereport\Session;
use gereport\View;

class AddEntryController implements Controller, AddEntryViewInfo
{
	/**
	 * @var AddEntryRequest
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
	 * @var ProjectDao
	 */
	private $projectDao;
	/**
	 * @var Config
	 */
	private $config;
	/**
	 * @var AddEntryRouter
	 */
	private $addEntryRouter;

	private $message;
	private $projectName;

	public function __construct($request, $session, $entryDao, $projectDao, $config, $addEntryRouter)
	{
		$this->request = $request;
		$this->session = $session;
		$this->entryDao = $entryDao;
		$this->projectDao = $projectDao;
		$this->config = $config;
		$this->addEntryRouter = $addEntryRouter;
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

		$projectId = $this->request->projectId();
		if ($projectId)
		{
			try { $this->projectName = $this->projectDao->findById($projectId)->name(); }
			catch (\Exception $ex) { return $this->error();	}
		}

		$this->message = null;
		if ($this->request->isPostMethod())
		{
			try
			{
				$id = $this->entryDao->insert($this->request->title(), $this->request->content(), $projectId,
					$this->session->loggedMemberId());
				$this->session->saveMessage('The entry has been submitted OK, now you can edit it if needed', false);
				(new Redirector(
					(new EditEntryRouter($this->config->rootUrl()))->url($id)
				))->redirect();
				return null;
			}
			catch (\Exception $ex)
			{
				$this->message = $ex->getMessage();
			}
		}

		return new AddEntryView($this->config, $this);
	}

	public function title()
	{
		return $this->request->title();
	}

	public function content()
	{
		return $this->request->content();
	}

	public function titleKey()
	{
		return $this->addEntryRouter->titleKey();
	}

	public function contentKey()
	{
		return $this->addEntryRouter->contentKey();
	}

	public function message()
	{
		return $this->message;
	}

	public function breadcrumb()
	{
		return (new Breadcrumb())->make(
			$this->request->projectId(), $this->projectName, $this->config->rootUrl()
		);
	}
}
