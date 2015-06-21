<?php

namespace gereport\mysqldomain;

abstract class MBO extends MSql
{
	protected $id;

	public function __construct($link, $id)
	{
		parent::__construct($link);
		$this->id = $id;
	}

	public function id()
	{
		return $this->id;
	}

	protected function retrieve($table, $targetField)
	{
		$statement = $this->link->prepare('SELECT `' . $targetField . '` FROM `' . $table . '` WHERE `id` = ?');
		$statement->bind_param('i', $this->id);

		$message = null;
		$ret = null;
		if ($statement->execute())
		{
			$result = $statement->get_result();
			if ($row = $result->fetch_array())
			{
				$ret = $row[$targetField];
			}
			else
			{
				$message = 'The '. $table . ' is not found';
			}
			$result->free_result();
		}
		else
		{
			$message = 'Could not retrieve the ' . $table . ' ' . $targetField;
		}
		$statement->close();
		if ($message) throw new \Exception($message);
		return $ret;
	}
}
