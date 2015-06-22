<?php

namespace gereport\entry\delete;

use gereport\Component;
use gereport\error\Error403View;
use gereport\error\Error404View;
use gereport\Redirector;
use gereport\router\DeleteEntryRouter;
use gereport\router\FoptionsRouter;
use gereport\View;

class DeleteEntryComponent extends Component
{
	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return new Error403View($this->config);
		$deleteEntryRouter = new DeleteEntryRouter($this->config->rootUrl());
		$request = new DeleteEntryRequest($this->httpRequest, $deleteEntryRouter);

		$entryId = $request->entryId();
		$folderId = null;
		try
		{
			$entry = $this->daoFactory->entry()->findById($entryId);
			$folderId = $entry->folderId();
		}
		catch (\Exception $ex)
		{
			return new Error404View($this->config);
		}

		try
		{
			$this->daoFactory->entry()->delete( $entryId );
			$message = 'The entry has been deleted OK';
			$isError = false;
		}
		catch (\Exception $ex)
		{
			$message = $ex->getMessage();
			$isError = true;
		}

		$this->session->saveMessage($message, $isError);
		$nextUrl = (new FoptionsRouter($this->config->rootUrl()))->url($folderId);
		(new Redirector($nextUrl))->redirect();

		return null;
	}
}
