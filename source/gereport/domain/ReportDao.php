<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:48 PM
 */

namespace gereport\domain;


interface ReportDao
{
	public function add($content, $projectId, $dateFor, $datetimeAdd, $memberId);

	public function delete($reportId);

	public function edit($reportId, $content, $datetime);

	/**
	 * @param $reportId
	 * @return Report
	 */
	public function findById($reportId);
}
