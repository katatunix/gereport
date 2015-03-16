<?php

namespace gereport\view;

__import('view/View');

class EditReportView extends View
{
	private $reportId;
	private $content;
	private $nextUrl;

	private $isActionSuccess;
	private $resultMessage;

	public function __construct($request, $urlSource, $htmlDir)
	{
		parent::__construct($request, $urlSource, $htmlDir);

		$this->reportId = $this->request->getDataGet('id');
		$this->nextUrl = $this->request->getDataGet('next');

		$this->content = $this->request->isPostMethod() ? $this->request->getDataPost('content') : '';

		$this->isActionSuccess = false;
		$this->resultMessage = '';
	}

	public function show()
	{
		require $this->htmlDir . 'EditReportHtml.php';
	}

	public function getReportId()
	{
		return $this->reportId;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getNextUrl()
	{
		return $this->nextUrl;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function setIsActionSuccess($success)
	{
		$this->isActionSuccess = $success;
	}

	public function setResultMessage($msg)
	{
		$this->resultMessage = $msg;
	}
}
