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
use gereport\domain\EntryDao;
use gereport\error\Error403View;
use gereport\index\IndexRouter;
use gereport\projecthome\ProjectHomeRouter;
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
	private $isShowingEditor;

	public function __construct($request, $session, $entryDao, $config, $editEntryRouter)
	{
		$this->request = $request;
		$this->session = $session;
		$this->entryDao = $entryDao;
		$this->config = $config;
		$this->editEntryRouter = $editEntryRouter;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged())
		{
			return new Error403View($this->config);
		}

		$this->message = null;
		$this->success = true;
		$this->isShowingEditor = true;

		$entry = $this->entryDao->findById($this->request->entryId());
		try
		{
			$this->projectId = $entry->projectId();
			if ($this->projectId)
			{
				$this->projectName = $entry->projectName();
			}
			if (!$this->request->isPostMethod())
			{
				$this->entryContent = $entry->content();
				$this->entryTitle = $entry->title();
			}
			else
			{
				$this->entryContent = $this->request->content();
				$this->entryTitle = $this->request->title();
				try
				{
					//$entry->update($this->reportContent, DatetimeUtils::getCurDatetime());
					$this->message = 'The entry has been saved OK';
				}
				catch (\Exception $ex)
				{
					$this->message = $ex->getMessage();
					$this->success = false;
				}
			}
		}
		catch (\Exception $ex)
		{
			$this->message = $ex->getMessage();
			$this->success = false;
			$this->isShowingEditor = false;
		}

		return new EditEntryView($this->config, $this);
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

	public function breadcrumbs()
	{
		$r = $this->config->rootUrl();
		$breads = array();

		$homeUrl = (new IndexRouter($r))->url();

		if (!$this->projectId)
		{
			$breads[] = array('Home', $homeUrl);
			$breads[] = array('Diary', $homeUrl);
		}
		else
		{
			$projectUrl = (new ProjectHomeRouter($r))->url($this->projectId);
			$breads[] = array($this->projectName, $projectUrl);
			$breads[] = array('Diary', $homeUrl);
		}

		return $breads;
	}

	public function isShowingEditor()
	{
		return $this->isShowingEditor;
	}
}
