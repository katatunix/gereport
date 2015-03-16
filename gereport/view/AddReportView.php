<?php

namespace gereport\view;

__import('view/View');

class AddReportView extends View
{
	private $projectId;
	private $dateFor;
	private $content;
	private $nextUrl;

	public function __construct($request, $urlSource, $htmlDir)
	{
		parent::__construct($request, $urlSource, $htmlDir);

		$this->projectId = $this->request->getData('projectId');
		$this->dateFor = $this->request->getData('dateFor');
		$this->content = $this->request->getData('content');
		$this->nextUrl = $this->request->getData('nextUrl');
	}

	public function show()
	{

	}

	public function getProjectId()
	{
		return $this->projectId;
	}

	public function getDateFor()
	{
		return $this->dateFor;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getNextUrl()
	{
		return $this->nextUrl;
	}
}
