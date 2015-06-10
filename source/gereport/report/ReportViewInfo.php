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
	 * 		Keys: 'memberUsername', 'isPast', 'datetimeAdd', 'canDelete',
	 *				'content', 'editUrl', 'deleteUrl'
	 */
	public function reports();

	/**
	 * @return array
	 */
	public function notReportedMemberUsernames();
}
