<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/10/2015
 * Time: 5:00 PM
 */

namespace gereport\mysqldomain;


class FieldRetriever
{
	/**
	 * @param $link \mysqli
	 * @param $table
	 * @param $targetField
	 * @param $idField
	 * @param $id
	 * @throws \Exception
	 * @return mixed
	 */
	public function retrieve($link, $table, $targetField, $idField, $id)
	{
		$statement = $link->prepare('SELECT `' . $targetField . '` FROM `' . $table . '` WHERE `' . $idField . '` = ?');
		$statement->bind_param('i', $id);

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
