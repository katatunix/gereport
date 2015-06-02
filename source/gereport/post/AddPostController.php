<?php

namespace gereport\post;

use gereport\decorator\Error403View;
use gereport\decorator\MainLayoutController;
use gereport\mysqldomain\MySqlMemberDao;
use gereport\mysqldomain\MySqlPostDao;
use gereport\mysqldomain\MySqlProjectDao;
use gereport\View;
use gereport\DatetimeUtils;

class AddPostController extends MainLayoutController
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		if (!$this->session->hasLogged())
		{
			return new Error403View($this->config);
		}

		$success = true;
		$message = null;
		$router = new AddPostRouter();

		try
		{
			$this->handle($router);
		}
		catch (\Exception $ex)
		{
			$success = false;
			$message = $ex->getMessage();
		}

		return new AddPostView($this->config, $success, $message, $router);
	}

	private function handle($router)
	{
		$request = new AddPostRequest($router);

		$title = $request->title();
		if (!$title)
		{
			throw new \Exception('The post title must not be empty!');
		}

		$content = $request->content();
		if (!$content)
		{
			throw new \Exception('The post content must not be empty!');
		}

		$projectId = $request->projectId();
		$projectDao = new MySqlProjectDao();
		if (! $projectDao->findById($projectId) )
		{
			throw new \Exception('The post title must not be empty!');
		}

		$authorId = $this->session->loggedMemberId();
		$memberDao = new MySqlMemberDao();
		if (! $memberDao->findById($authorId) )
		{
			throw new \Exception('The author is not found!');
		}

		$postDao = new MySqlPostDao();
		$time = DatetimeUtils::getCurDatetime();
		$postDao->insert($title, $content, $projectId, $authorId, $time, $authorId, $time);
	}
}
