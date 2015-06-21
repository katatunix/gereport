<?php

namespace gereport\entry\add;

use gereport\Component;
use gereport\error\Error403View;
use gereport\Redirector;
use gereport\router\AddEntryRouter;
use gereport\router\EditEntryRouter;
use gereport\View;

class AddEntryComponent extends Component implements AddEntryViewInfo
{
	private $message;

	/**
	 * @var AddEntryRequest
	 */
	private $request;

	/**
	 * @var AddEntryRouter
	 */
	private $router;

	public function __construct($httpRequest, $session, $config, $daoFactory)
	{
		parent::__construct($httpRequest, $session, $config, $daoFactory);
		$this->router = new AddEntryRouter($httpRequest);
		$this->request = new AddEntryRequest($httpRequest, $this->router);
	}

	private function error()
	{
		return new Error403View($this->config);
	}

	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return $this->error();

		$folderId = $this->request->folderId();

		$folderName = null;
		try { $folderName = $this->daoFactory->folder()->findById($folderId)->name(); }
		catch (\Exception $ex) { return $this->error(); }

		$this->message = null;
		if ($this->request->isPostMethod())
		{
			try
			{
				$id = $this->daoFactory->entry()->insert(
					$this->request->title(),
					$this->request->content(),
					$folderId,
					$this->session->loggedMemberId()
				);

				$this->session->saveMessage('The entry has been submitted OK', false);

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

		return new AddEntryView($this->config, 'Add a new entry for folder ' . $folderName, $this);
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
		return $this->router->titleKey();
	}

	public function contentKey()
	{
		return $this->router->contentKey();
	}

	public function message()
	{
		return $this->message;
	}
}
