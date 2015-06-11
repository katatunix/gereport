<?php

namespace gereport\report\edit;

interface EditReportViewInfo
{
	public function message();

	public function content();
	public function contentKey();
	public function nextUrl();
}
