<?php

namespace gereport\domain;

interface ReportDao
{
	public function insert($content, $projectId, $dateFor, $datetimeAdd, $memberId);

	/**
	 * @param $reportId
	 * @return void
	 */
	public function delete($reportId);

	/**
	 * @param $reportId
	 * @return Report
	 */
	public function findById($reportId);
}
