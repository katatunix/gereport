<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:46 PM
 */

namespace gereport\mysqldomain;

use gereport\domain\Project;

class MProject implements Project
{
	/**
	 * @var \mysqli
	 */
	private $link;
	private $id;

	public function __construct($link, $id)
	{
		$this->link = $link;
		$this->id = $id;
	}

	public function name()
	{
		$statement = $this->link->prepare('SELECT `name` FROM `project` WHERE `id` = ?');
		$statement->bind_param('i', $this->id);
		$statement->execute();
		$result = $statement->get_result();
		$row = $result->fetch_array();
		$name = $row['name'];
		$result->free_result();
		$statement->close();
		return $name;
	}
}
