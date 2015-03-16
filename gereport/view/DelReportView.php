<?php

namespace gereport\view;

__import('view/View');

class DelReportView extends View
{
	private $reportId;
	private $nextUrl;

	public function __construct($request, $urlSource, $htmlDir)
	{
		parent::__construct($request, $urlSource, $htmlDir);
		$this->reportId = $this->request->getData('reportId');
		$this->nextUrl = $this->request->getData('nextUrl');
	}

	public function show()
	{

	}

	public function getReportId()
	{
		return $this->reportId;
	}

	public function getNextUrl()
	{
		return $this->nextUrl;
	}
}
