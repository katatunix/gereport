<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:45 PM
 */

namespace gereport\mysqldomain;


use gereport\domain\PostDao;

class MPostDao extends MySqlDao implements PostDao
{

	public function insert($title, $content, $projectId, $authorId, $time, $authorId, $time)
	{
		// TODO: Implement insert() method.
	}
}
