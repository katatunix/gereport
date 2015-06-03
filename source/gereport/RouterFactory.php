<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/2/2015
 * Time: 11:25 PM
 */

namespace gereport;

use gereport\authen\LoginRouter;
use gereport\authen\LogoutRouter;
use gereport\index\IndexRouter;
use gereport\options\ChangePasswordRouter;
use gereport\options\OptionsRouter;

class RouterFactory
{
	private $rootUrl;

	public function __construct($rootUrl)
	{
		$this->rootUrl = $rootUrl;
	}

	public function index()
	{
		return new IndexRouter($this->rootUrl);
	}

	public function login()
	{
		return new LoginRouter($this->rootUrl);
	}

	public function logout()
	{
		return new LogoutRouter($this->rootUrl);
	}

	public function options()
	{
		return new OptionsRouter($this->rootUrl);
	}

	public function cpass()
	{
		return new ChangePasswordRouter($this->rootUrl);
	}
}
