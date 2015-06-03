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
	/**
	 * @var Redirector
	 */
	private $redirector;

	public function __construct($rootUrl)
	{
		$this->rootUrl = $rootUrl;
		$this->redirector = new Redirector();
	}

	public function redirectTo($url)
	{
		$this->redirector->redirect($url);
	}

	public function index()
	{
		return new IndexRouter($this->rootUrl, $this->redirector);
	}

	public function login()
	{
		return new LoginRouter($this->rootUrl, $this->redirector);
	}

	public function logout()
	{
		return new LogoutRouter($this->rootUrl, $this->redirector);
	}

	public function options()
	{
		return new OptionsRouter($this->rootUrl, $this->redirector);
	}

	public function cpass()
	{
		return new ChangePasswordRouter($this->rootUrl, $this->redirector);
	}
}
