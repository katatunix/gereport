<?php

namespace gereport\foptions;

use gereport\Config;
use gereport\Controller;
use gereport\domain\Folder;
use gereport\domain\FolderDao;
use gereport\error\Error403View;
use gereport\Redirector;
use gereport\Session;
use gereport\View;

class FoptionsController implements Controller, FoptionsViewInfo
{
	/**
	 * @var FoptionsRequest
	 */
	private $request;

	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var FolderDao
	 */
	private $folderDao;

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var FoptionsRouter
	 */
	private $router;

	private $folderName;

	private $message, $success;

	public function __construct($request, $session, $folderDao, $config, $router)
	{
		$this->request = $request;
		$this->session = $session;
		$this->folderDao = $folderDao;
		$this->config = $config;
		$this->router  =$router;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged()) return new Error403View($this->config);

		$folderId = $this->request->folderId();
		$folder = $this->folderDao->findById($folderId);
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
		$nextUrl = $this->router->url( $folderId );
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
			$this->folderDao->insert($newSubFolderName, $parentFolderId);
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
			$this->folderDao->delete($folderId); // TODO: delete all sub-folders and entries too
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
}
