<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 3:54 PM
 */

namespace gereport\logout;


use gereport\Redirector;
use gereport\Session;

class LogoutResponse
{
	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var Redirector
	 */
	private $indexRedirector;

	public function __construct($session, $indexRedirector)
	{
		$this->session = $session;
		$this->indexRedirector = $indexRedirector;
	}

	public function execute()
	{
		$this->session->clearLogin();
		$this->indexRedirector->redirect();
	}
}
