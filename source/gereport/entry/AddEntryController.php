<?php

namespace gereport\entry;

use gereport\Config;
use gereport\Controller;
use gereport\DatetimeUtils;
use gereport\domain\EntryDao;
use gereport\error\Error403View;
use gereport\Session;
use gereport\View;

class AddPostController implements Controller, AddEntryViewInfo
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
	private $postDao;
	/**
	 * @var Config
	 */
	private $config;
	/**
	 * @var AddEntryRouter
	 */
	private $router;

	private $message;

	public function __construct($request, $session, $postDao, $config, $router)
	{
		$this->request = $request;
		$this->session = $session;
		$this->postDao = $postDao;
		$this->config = $config;
		$this->router = $router;
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
		if ($this->request->isPostMethod())
		{
			$memberId = $this->session->loggedMemberId();
			$datetime = DatetimeUtils::getCurDatetime();
			try
			{
				$this->postDao->insert(
					$this->request->title(),
					$this->request->content(),
					$this->request->projectId(),
					$memberId,
					$datetime,
					$memberId,
					$datetime
				);
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
