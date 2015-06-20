<?php

namespace gereport\report;

interface ReportViewInfo
{
	public function projectId();
	public function projectIdKey();
	public function date();
	public function dateKey();
	public function isAllowSubmittingReport();
	public function currentUrl();

	public function message();
	public function success();

	/**
	 * @return array
	 */
	public function reports();

	/**
	 * @return array
	 */
	public function notReportedMemberUsernames();

	public function addReportUrl();
	public function addReportProjectIdKey();
	public function addReportDateForKey();
	public function addReportNextUrlKey();
	public function addReportContentKey();

	public function deleteReportUrl();
	public function deleteReportReportIdKey();
	public function deleteReportNextUrlKey();
}
