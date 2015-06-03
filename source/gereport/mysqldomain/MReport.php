<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 5:46 PM
 */

namespace gereport\mysqldomain;


use gereport\domain\Report;

class MReport implements Report
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

	public function content()
	{
		// TODO: Implement content() method.
	}

	public function datetimeAdd()
	{
		// TODO: Implement datetimeAdd() method.
	}

	public function memberUsername()
	{
		// TODO: Implement memberUsername() method.
	}

	public function isPast()
	{
		// TODO: Implement isPast() method.
	}

	public function update($content, $datetime)
	{
		// TODO: Implement update() method.
	}
}
