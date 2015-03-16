<?php

namespace gereport\view;

interface UrlSource
{
	public function getHtmlUrl();

	public function getIndexUrl();

	public function getLoginUrl();
	public function getLogoutUrl();

	public function getReportUrl();
	public function getAddReportUrl();
	public function getDelReportUrl();

	public function getOptionsUrl();
	public function getChangePasswordUrl();
}
