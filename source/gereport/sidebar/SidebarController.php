<?php

namespace gereport\sidebar;

use gereport\Config;
use gereport\domain\Folder;
use gereport\domain\Project;
use gereport\domain\ProjectDao;
use gereport\Controller;
use gereport\entry\EntryRouter;
use gereport\foptions\FoptionsRouter;
use gereport\report\ReportRouter;
use gereport\Session;
use gereport\View;

class SidebarController implements Controller, SidebarViewInfo
{
	/**
	 * @var Session
	 */
	private $session;
	/**
	 * @var ProjectDao
	 */
	private $projectDao;

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var EntryRouter
	 */
	private $entryRouter;

	/**
	 * @var ReportRouter
	 */
	private $reportRouter;

	/**
	 * @var FoptionsRouter
	 */
	private $foptionsRouter;

	private $currentUrl;

	public function __construct($session, $projectDao, $config,
								$entryRouter, $reportRouter, $foptionsRouter,
								$currentUrl)
	{
		$this->session = $session;
		$this->projectDao = $projectDao;
		$this->config = $config;
		$this->entryRouter = $entryRouter;
		$this->reportRouter = $reportRouter;
		$this->foptionsRouter = $foptionsRouter;
		$this->currentUrl = $currentUrl;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		return new SidebarView($this->config, $this);
	}

	/**
	 * @return array
	 */
	public function tree()
	{
		$rootStructures = array();
		try
		{
			foreach ($this->projectDao->findByAllAndSortByName() as $project)
			{
				$rootStructures[] = $this->makeFolderForProject($project);
			}
		}
		catch (\Exception $ex)
		{
			$rootStructures = array();
		}
		return $rootStructures;
	}

	public function currentUrl()
	{
		return $this->currentUrl;
	}

	/**
	 * @param $project Project
	 * @return array
	 */
	private function makeFolderForProject($project)
	{
		$folder = $this->makeFolder($project->name());

		$children = array();
		$children[] = $this->makeEntry( 'Report', $this->reportRouter->url($project->id()) );
		$children[] = $this->makeFolderFull( $project->folder() );

		$this->append($children, $folder);

		return $folder;
	}

	private function append(& $children, & $dad)
	{
		$dad['children'] = $children;
	}

	private function makeFolder($name)
	{
		return array('isFolder' => true, 'name' => $name);
	}

	private function makeEntry($title, $url)
	{
		return array('isFolder' => false, 'title' => $title, 'url' => $url);
	}

	/**
	 * @param $folder Folder
	 * @return array
	 */
	private function makeFolderFull($folder)
	{
		$folderStruct = $this->makeFolder($folder->name());
		$children = array();

		foreach ($folder->subFolders() as $subFolder)
		{
			$children[] = $this->makeFolderFull($subFolder);
		}

		if ($this->session->hasLogged())
		{
			$children[] = $this->makeEntry('Folder options', $this->foptionsRouter->url($folder->id()));
		}

		foreach ($folder->entries() as $entry)
		{
			$children[] = $this->makeEntry( $entry->title(), $this->entryRouter->url($entry->id()) );
		}

		$this->append($children, $folderStruct);

		return $folderStruct;
	}
}
