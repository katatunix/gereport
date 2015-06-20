<?php

namespace gereport\sidebar;

use gereport\Component;
use gereport\domain\Folder;
use gereport\domain\Project;
use gereport\router\EntryRouter;
use gereport\router\FoptionsRouter;
use gereport\router\ReportRouter;
use gereport\View;

class SidebarComponent extends Component implements SidebarViewInfo
{
	/**
	 * @var ReportRouter
	 */
	private $reportRouter;
	/**
	 * @var FoptionsRouter
	 */
	private $foptionsRouter;
	/**
	 * @var EntryRouter
	 */
	private $entryRouter;

	/**
	 * @return View
	 */
	public function view()
	{
		return new SidebarView($this->config, $this);
	}

	/**
	 * @return array
	 */
	public function tree()
	{
		$rootStructures = array();
		$rootUrl = $this->config->rootUrl();
		$this->reportRouter = new ReportRouter($rootUrl);
		$this->foptionsRouter = new FoptionsRouter($rootUrl);
		$this->entryRouter = new EntryRouter($rootUrl);

		try
		{
			foreach ($this->daoFactory->project()->findByAllAndSortByName() as $project)
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
		return $this->httpRequest->url();
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
