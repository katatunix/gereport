<?php

namespace gereport\entry;

use gereport\Config;
use gereport\Controller;
use gereport\DatetimeUtils;
use gereport\domain\PostDao;
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
	 * @var PostDao
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

		$memberId = $this->session->loggedMemberId();
		$datetime = DatetimeUtils::getCurDatetime();

		$message = null;

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
			$message = $ex->getMessage();
		}
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
		// TODO: Implement message() method.
	}
}
