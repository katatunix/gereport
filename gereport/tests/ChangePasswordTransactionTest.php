<?php

namespace gereport\tests;

__import('database/MockDatabase');
__import('transaction/ChangePasswordTransaction');
__import('domainproxy/MemberProxy');

use gereport\database\MockDatabase;
use gereport\domainproxy\MemberProxy;
use gereport\transaction\ChangePasswordTransaction;

class ChangePasswordTransactionTest extends \PHPUnit_Framework_TestCase
{
	public function testNormal()
	{
		$database = new MockDatabase();

		$tx = new ChangePasswordTransaction(1, '1234567', 'xxx', 'xxx', $database);
		$tx->execute();

		$member = new MemberProxy(1, $database);
		$this->assertTrue($member->hasPassword('xxx'));
	}

	/**
	 * @expectedException \Exception
	 */
	public function testWrongPassword()
	{
		$database = new MockDatabase();

		$tx = new ChangePasswordTransaction(1, '1234567a', 'xxx', 'xxx', $database);
		$tx->execute();
	}

	/**
	 * @expectedException \Exception
	 */
	public function testBlankNewPassword()
	{
		$database = new MockDatabase();

		$tx = new ChangePasswordTransaction(1, '1234567', '', 'xxx', $database);
		$tx->execute();
	}

	/**
	 * @expectedException \Exception
	 */
	public function testNewPasswordNotMatched()
	{
		$database = new MockDatabase();

		$tx = new ChangePasswordTransaction(1, '1234567', 'yyy', 'xxx', $database);
		$tx->execute();
	}
}
