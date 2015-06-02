<?php

namespace gereport\database;

use p8p\Database;
use p8p\MySqlDatabase;

class GrMySqlDatabase extends MySqlDatabase implements Database, GrDatabase
{

	public function hasMember($id)
	{
		return $this->hasRow('member', $id);
	}

	public function findMember($id)
	{
		return $this->findRow('member', $id);
	}

	public function findRow($tableName, $id)
	{
		$statement = $this->link->prepare('SELECT * FROM `' . $tableName . '` WHERE `id` = ?');
		$statement->bind_param('i', $id);
		return $this->fetchRow($statement);
	}

	public function findMemberByLogin($username, $password)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `member` WHERE `username` = ? AND `password` = ?');
		$statement->bind_param('ss', $username, $password);
		$row = $this->fetchRow($statement);
		return $row ? $row['id'] : 0;
	}

	public function findNotReportedMembers($projectId, $date)
	{
		$statement = $this->link->prepare('
			SELECT M.`id`
			FROM `member` M, `memberproject` MP
			WHERE
				M.`id` = MP.`memberId` AND
				MP.`projectId` = ? AND
				M.`id` NOT IN (
					SELECT A.`memberId` FROM `report` A
					WHERE A.`projectId` = ?
						AND A.`dateFor` = ?
				)
			ORDER BY M.`username`
		');
		$statement->bind_param('iis', $projectId, $projectId, $date);
		return $this->fetchIdsFromStatement($statement);
	}

	public function isMemberHasPassword($memberId, $password)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `member` WHERE `id` = ? AND `password` = ?');
		$statement->bind_param('is', $memberId, $password);
		return $this->fetchRow($statement) ? true : false;
	}

	public function updateMemberPassword($id, $newPassword)
	{
		$statement = $this->link->prepare('UPDATE `member` SET `password` = ? WHERE `id` = ?');
		$statement->bind_param('si', $newPassword, $id);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('updateMemberPassword: database error');
	}

	public function insertMember($username, $password, $group)
	{
		$statement = $this->link->prepare(
			'INSERT INTO `member`(`username`, `password`, `group`) VALUES(?, ?, ?)');
		$statement->bind_param('ssi', $username, $password, $group);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('insertMember: database error');
	}

	//=====================================================================================================

	public function hasProject($id)
	{
		return $this->hasRow('project', $id);
	}

	public function findProject($id)
	{
		return $this->findRow('project', $id);
	}

	public function findProjects()
	{
		return $this->findRowIds('project', 'name');
	}

	public function insertProject($name)
	{
		$statement = $this->link->prepare('INSERT INTO `project`(`name`) VALUES(?)');
		$statement->bind_param('s', $name);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('insertProject: database error');
	}

	//=====================================================================================================

	public function isMemberWorkingForProject($memberId, $projectId)
	{
		$statement = $this->link->prepare('
			SELECT `memberId` FROM `memberproject` WHERE `memberId` = ? AND `projectId` = ?
		');
		$statement->bind_param('ii', $memberId, $projectId);
		return $this->fetchRow($statement) ? true : false;
	}

	public function addMemberToProject($memberId, $projectId)
	{
		$statement = $this->link->prepare('INSERT INTO `memberproject`(`memberId`, `projectId`) VALUES(?, ?)');
		$statement->bind_param('ii', $memberId, $projectId);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('addMemberToProject: database error');
	}

	//=====================================================================================================

	public function hasReport($id)
	{
		return $this->hasRow('report', $id);
	}

	public function findReport($id)
	{
		return $this->findRow('report', $id);
	}

	public function findReportsByProjectAndDate($projectId, $date)
	{
		$statement = $this->link->prepare('
			SELECT `id` FROM `report` WHERE `projectId` = ? AND `dateFor` = ? ORDER BY `datetimeAdd` DESC
		');
		$statement->bind_param('is', $projectId, $date);
		return $this->fetchIdsFromStatement($statement);
	}

	public function insertReport($memberId, $projectId, $dateFor, $datetimeAdd, $content)
	{
		$statement = $this->link->prepare('
			INSERT INTO `report`(`memberId`, `projectId`, `dateFor`, `datetimeAdd`, `content`)
			VALUES(?, ?, ?, ?, ?)
		');
		$statement->bind_param('iisss', $memberId, $projectId, $dateFor, $datetimeAdd, $content);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('insertReport: database error');
	}

	public function deleteReport($reportId)
	{
		$statement = $this->link->prepare('DELETE FROM `report` WHERE `id` = ?');
		$statement->bind_param('i', $reportId);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('deleteReport: database error');
	}

	public function updateReport($reportId, $content, $datetime)
	{
		$statement = $this->link->prepare('
			UPDATE `report` SET `content` = ?, `datetimeAdd` = ? WHERE `id` = ?
		');
		$statement->bind_param('ssi', $content, $datetime, $reportId);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('updateReport: database error');
	}

	//=====================================================================================================

	public function hasPost($id)
	{
		return $this->hasRow('post', $id);
	}

	public function findPost($id)
	{
		return $this->findRow('post', $id);
	}

	public function insertPost($title, $content, $projectId, $authorId, $createdTime, $lastEditorId, $lastEditedTime)
	{
		$statement = $this->link->prepare('
			INSERT INTO `post`(`title`, `content`, `projectId`, `authorId`, `createdTime`, `lastEditorId`, `lastEditedTime`)
			VALUES(?, ?, ?, ?, ?, ?, ?)
		');
		$statement->bind_param('ssiisis', $title, $content, $projectId,
			$authorId, $createdTime, $lastEditorId, $lastEditedTime);
		$ok = $statement->execute();
		$statement->close();
		if (!$ok) throw new \Exception('insertPost: database error');
	}

}
