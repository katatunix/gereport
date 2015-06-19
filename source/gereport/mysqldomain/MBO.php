<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 4:04 PM
 */

namespace gereport\mysqldomain;

abstract class MBO
{
	/**
	 * @var \mysqli
	 */
	protected $link;

	protected $id;

	public function __construct($link, $id)
	{
		$this->link = $link;
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
