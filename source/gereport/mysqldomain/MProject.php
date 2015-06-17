<?php

namespace gereport\mysqldomain;

use gereport\domain\Folder;
use gereport\domain\Project;

class MProject extends MBO implements Project
{
	public function name()
	{
		return $this->retrieve('project', 'name');
	}

	public function hasMember($memberId)
	{
		$statement = $this->link->prepare('
			SELECT `memberId` FROM `memberproject` WHERE `memberId` = ? AND `projectId` = ?
		');
		$statement->bind_param('ii', $memberId, $this->id);

		$ok = false;
		$message = null;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			$ok = $result->fetch_array() ? true : false;
			$result->free_result();
		}
		else
		{
			$message = 'Could not check the project and member';
		}
		$statement->close();
		if ($message) throw new \Exception($message);
		return $ok;
	}

	/**
	 * @return Folder
	 */
	public function folder()
	{
		$folderId = $this->retrieve('project', 'folderId');
		return new MFolder($this->link, $folderId);
	}
}
