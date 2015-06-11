<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 10:43 AM
 */

namespace tests;


use gereport\DaoFactory;

class Factory
{
	public function createDaoFactory()
	{
		return new DaoFactory('localhost', 'root', '', 'gereport');
	}
}
