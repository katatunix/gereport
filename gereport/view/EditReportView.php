<?php

namespace gereport\view;

__import('view/View');

class EditReportView extends View
{
	private $content;
	private $isActionSuccess;
	private $resultMessage;
	private $nextUrl;

	public function __construct($urlSource, $htmlDir)
	{
		parent::__construct($urlSource, $htmlDir);

		$this->content = '';
		$this->isActionSuccess = false;
		$this->resultMessage = '';
	}

	public function show()
	{
		require $this->htmlDir . 'EditReportHtml.php';
	}

	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}

	public function setIsActionSuccess($success)
	{
		$this->isActionSuccess = $success;
		return $this;
	}

	public function setResultMessage($msg)
	{
		$this->resultMessage = $msg;
		return $this;
	}

	public function setNextUrl($url)
	{
		$this->nextUrl = $url;
		return $this;
	}

}
