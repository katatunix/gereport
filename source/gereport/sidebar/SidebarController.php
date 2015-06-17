<?php

namespace gereport\sidebar;

use gereport\Config;
use gereport\domain\Folder;
use gereport\domain\Project;
use gereport\domain\ProjectDao;
use gereport\Controller;
use gereport\entry\EntryRouter;
use gereport\report\ReportRouter;
use gereport\View;

class SidebarController implements Controller, SidebarViewInfo
{
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

	public function __construct($projectDao, $config, $entryRouter, $reportRouter)
	{
		$this->projectDao = $projectDao;
		$this->config = $config;
		$this->entryRouter = $entryRouter;
		$this->reportRouter = $reportRouter;
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

	/**
	 * @param $project Project
	 * @return array
	 */
	private function makeFolderForProject($project)
	{
		$folder = $this->makeCoreFolder($project->name());

		$children = array();
		$children[] = $this->makeEntry( 'Report', $this->reportRouter->url($project->id()) );
		$children[] = $this->makeFolder( $project->folder() );

		$this->append($children, $folder);

		return $folder;
	}

	private function append(&$children, &$dad)
	{
		$dad['children'] = $children;
	}

	private function makeCoreFolder($name)
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
	private function makeFolder($folder)
	{
		$folderStruct = $this->makeCoreFolder($folder->name());
		$children = array();

		foreach ($folder->subFolders() as $subFolder)
		{
			$children[] = $this->makeFolder($subFolder);
		}

		foreach ($folder->entries() as $entry)
		{
			$children[] = $this->makeEntry( $entry->title(), $this->entryRouter->url($entry->id()) );
		}

		$this->append($children, $folderStruct);

		return $folderStruct;
	}
}
