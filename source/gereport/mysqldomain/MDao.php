<?php

namespace gereport\mysqldomain;

abstract class MDao
{
	/**
	 * @var \mysqli
	 */
	protected $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	protected function exists($table, $id)
	{
		$statement = $this->link->prepare('SELECT `id` FROM `' . $table . '` WHERE `id` = ?');
		$statement->bind_param('i', $id);

		$message = null;
		$ret = true;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			$ret = $result->fetch_array() ? true : false;
			$result->free_result();
		}
		else
		{
			$message = 'Could not check existence of the ' . $table;
		}
		$statement->close();
		if ($message) throw new \Exception($message);
		return $ret;
	}

	protected function deleteTableRow($table, $id)
	{
		$statement = $this->link->prepare('DELETE FROM `' . $table . '` WHERE `id` = ?');
		$statement->bind_param('i', $id);

		$message = null;
		if (!$statement->execute())
		{
			$message = 'Could not delete the ' . $table;
		}
		else if ($this->link->affected_rows == 0)
		{
			$message = 'Could not find the ' . $table;
		}
		$statement->close();
		if ($message) throw new \Exception($message);
	}
}
