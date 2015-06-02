<?php

namespace gereport\database;

interface GrDatabase
{
	public function hasMember($id);
	public function findMember($id);
	public function findMemberByLogin($username, $password);
	public function findNotReportedMembers($projectId, $date);
	public function isMemberHasPassword($memberId, $password);
	public function updateMemberPassword($id, $newPassword);
	public function insertMember($username, $password, $group);

	public function hasProject($id);
	public function findProject($id);
	public function findProjects();
	public function insertProject($name);

	public function isMemberWorkingForProject($memberId, $projectId);
	public function addMemberToProject($memberId, $projectId);

	public function hasReport($id);
	public function findReport($id);
	public function findReportsByProjectAndDate($projectId, $date);
	public function insertReport($memberId, $projectId, $dateFor, $datetimeAdd, $content);
	public function deleteReport($reportId);
	public function updateReport($reportId, $content, $datetime);

	public function hasPost($id);
	public function findPost($id);
	public function insertPost($title, $content, $projectId, $authorId, $createdTime, $lastEditorId, $lastEditedTime);
}
