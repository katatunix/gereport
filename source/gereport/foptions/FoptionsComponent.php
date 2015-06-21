<?php

namespace gereport\foptions;

use gereport\Component;
use gereport\domain\Folder;
use gereport\error\Error403View;
use gereport\Redirector;
use gereport\router\FoptionsRouter;
use gereport\View;

class FoptionsComponent extends Component implements FoptionsViewInfo
{
	private $folderName;

	private $message, $success;

	/**
	 * @var FoptionsRouter
	 */
	private $foptionsRouter;
	/**
	 * @var FoptionsRequest
	 */
	private $request;

	public function __construct($httpRequest, $session, $config, $daoFactory)
	{
		parent::__construct($httpRequest, $session, $config, $daoFactory);

		$this->foptionsRouter = new FoptionsRouter($this->config->rootUrl());
		$this->request = new FoptionsRequest($this->httpRequest, $this->foptionsRouter);
	}

	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return new Error403View($this->config);

		$folderId = $this->request->folderId();
		$folder = $this->daoFactory->folder()->findById($folderId);
		if (!$folder) return new Error403View($this->config);

		if (!$this->request->isPostMethod())
		{
			try
			{
				$this->folderName = $folder->name();
			}
			catch (\Exception $ex)
			{
				return new Error403View($this->config);
			}
			return new FoptionsView($this->config, 'Folder options for ' . $this->folderName, $this);
		}

		if ($this->request->isAdd())
		{
			$this->handleAdd($folderId);
		}
		else if ($this->request->isRename())
		{
			$this->handleRename($folder);
		}
		else if ($this->request->isDelete())
		{
			$this->handleDelete($folderId);
		}

		$this->session->saveMessage($this->message, !$this->success);
		$nextUrl = $this->foptionsRouter->url( $folderId );
		(new Redirector($nextUrl))->redirect();
		return null;
	}

	private function handleAdd($parentFolderId)
	{
		$this->success = false;
		$newSubFolderName = $this->request->folderName();
		if (!$newSubFolderName)
		{
			$this->message = 'The sub-folder name is empty';
			return;
		}

		try
		{
			$this->daoFactory->folder()->insert($newSubFolderName, $parentFolderId);
		}
		catch (\Exception $ex)
		{
			$this->message = $ex->getMessage();
			return;
		}
		$this->message = 'The sub-folder has been added OK';
		$this->success = true;
	}

	/**
	 * @param $folder Folder
	 */
	private function handleRename($folder)
	{
		$this->success = false;
		$newFolderName = $this->request->folderName();

		if (!$newFolderName)
		{
			$this->message = 'The new folder name is empty';
			return;
		}

		try
		{
			$folder->rename($newFolderName);
		}
		catch (\Exception $ex)
		{
			$this->message = $ex->getMessage();
			return;
		}
		$this->message = 'The folder has been renamed OK';
		$this->success = true;
	}

	private function handleDelete($folderId)
	{
		$this->success = false;
		try
		{
			$this->daoFactory->folder()->delete($folderId);
		}
		catch (\Exception $ex)
		{
			$this->message = $ex->getMessage();
			return;
		}
		$this->message = 'The folder has been deleted OK';
		$this->success = true;
	}

	public function folderName()
	{
		return $this->folderName;
	}

	public function folderNameKey()
	{
		return $this->foptionsRouter->folderNameKey();
	}

	public function actionKey()
	{
		return $this->foptionsRouter->actionKey();
	}

	public function actionAddValue()
	{
		return $this->foptionsRouter->actionAddValue();
	}

	public function actionRenameValue()
	{
		return $this->foptionsRouter->actionRenameValue();
	}

	public function actionDeleteValue()
	{
		return $this->foptionsRouter->actionDeleteValue();
	}
}
