<?php

namespace gereport\tests;

__import('database/MockDatabase');
__import('transaction/GetUsernameTransaction');

use gereport\database\MockDatabase;
use gereport\transaction\GetUsernameTransaction;

class GetUsernameTransactionTest extends \PHPUnit_Framework_TestCase
{
	public function testNghiaBuiVan()
	{
		$database = new MockDatabase();
		$tx = new GetUsernameTransaction(1, $database);
		$tx->execute();
		$this->assertEquals('nghia.buivan', $tx->getMemberUsername());
	}

	public function testCanhNguyenNgoc()
	{
		$database = new MockDatabase();
		$tx = new GetUsernameTransaction(2, $database);
		$tx->execute();
		$this->assertEquals('canh.nguyenngoc', $tx->getMemberUsername());
	}
}
