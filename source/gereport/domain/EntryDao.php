<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:47 PM
 */

namespace gereport\domain;

interface EntryDao
{
	public function insert($title, $content, $projectId, $authorId, $time, $authorId, $time);
}
