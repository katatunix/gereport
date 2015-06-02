<?php

namespace gereport\domainproxy;

use gereport\database\GrDatabase;

abstract class Proxy
{
	protected $id;

	/**
	 * @var GrDatabase
	 */
	protected $database;

	public function __construct($id, $database)
	{
		$this->id = $id;
		$this->database = $database;
	}
}
