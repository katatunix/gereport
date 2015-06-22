<?php

namespace gereport\report\edit;

use gereport\Component;
use gereport\error\Error403View;
use gereport\error\Error404View;
use gereport\Redirector;
use gereport\router\EditReportRouter;
use gereport\View;

class EditReportComponent extends Component implements EditReportViewInfo
{
	private $message, $reportContent;
	private $nextUrl, $contentKey;

	private function error403()
	{
		return new Error403View($this->config);
	}

	private function error404()
	{
		return new Error404View($this->config);
	}

	/**
	 * @return View
	 */
	public function view()
	{
		if (!$this->session->hasLogged()) return $this->error403();

		$editReportRouter = new EditReportRouter($this->config->rootUrl());
		$request = new EditReportRequest($this->httpRequest, $editReportRouter);

		$this->contentKey = $editReportRouter->contentKey();
		$this->nextUrl = $request->nextUrl();

		try
		{
			$report = $this->daoFactory->report()->findById($request->reportId());
		}
		catch (\Exception $ex)
		{
			return $this->error404();
		}

		$this->message = null;

		if (!$request->isPostMethod())
		{
			try
			{
				$this->reportContent = $report->content();
			}
			catch (\Exception $ex)
			{
				$this->message = $ex->getMessage();
			}
		}
		else
		{
			$this->reportContent = $request->content();
			$success = true;
			try
			{
				$report->update($this->reportContent);
			}
			catch (\Exception $ex)
			{
				$success = false;
				$this->message = $ex->getMessage();
			}

			if ($success)
			{
				$this->session->saveMessage('The report has been saved OK', false);
				(new Redirector( $this->nextUrl() ))->redirect();
				return null;
			}
		}

		return new EditReportView($this->config, $this);
	}

	public function message()
	{
		return $this->message;
	}

	public function content()
	{
		return $this->reportContent;
	}

	public function contentKey()
	{
		return $this->contentKey;
	}

	public function nextUrl()
	{
		return $this->nextUrl;
	}
}
