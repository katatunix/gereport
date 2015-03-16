<?php

namespace gereport\tests;

__import('database/MockDatabase');
__import('transaction/GetReportContentTransaction');
__import('transaction/AddReportTransaction');

use gereport\database\MockDatabase;
use gereport\transaction\AddReportTransaction;
use gereport\transaction\GetReportContentTransaction;

class GetReportContentTransactionTest extends \PHPUnit_Framework_TestCase
{
	public function testFixBugsHello()
	{
		$database = new MockDatabase();
		$memberId = 1;
		$projectId = 1;
		$transaction = new AddReportTransaction($memberId, $projectId,
			'2015-02-28', '2015-02-27 17:30', 'Fix bugs hello', $database);
		$transaction->execute();

		$reportId = $database->getLastInsertedId();

		$tx = new GetReportContentTransaction($reportId, $database);
		$tx->execute();

		$this->assertEquals('Fix bugs hello', $tx->getContent());
	}

	/**
	 * @expectedException \Exception
	 */
	public function testException()
	{
		$database = new MockDatabase();
		$tx = new GetReportContentTransaction(10000000, $database);
		$tx->execute();
	}
}
