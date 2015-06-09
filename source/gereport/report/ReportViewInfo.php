<?php

namespace gereport\report;

interface ReportViewInfo
{
	public function projectId();
	public function date();
	public function isAllowAddingReport();
	public function currentUrl();

	public function message();
	public function success();

	/**
	 * @return array
	 * 		Keys: 'memberUsername', 'isPast', 'datetimeAdd', 'canDelete',
	 *				'content', 'editUrl', 'deleteUrl'
	 */
	public function reports(); //

	/**
	 * @return array
	 */
	public function notReportedMemberUsernames();
}
