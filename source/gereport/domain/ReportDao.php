<?php

namespace gereport\domain;

interface ReportDao
{
	/**
	 * @param $id
	 * @return Report
	 */
	public function findById($id);

	/**
	 * @param $projectId
	 * @param $date
	 * @return Report[]
	 */
	public function findByProjectAndDate($projectId, $date);

	/**
	 * @param $content
	 * @param $projectId
	 * @param $dateFor
	 * @param $memberId
	 * @return int
	 */
	public function insert($content, $projectId, $dateFor, $memberId);
	public function delete($id);
}
