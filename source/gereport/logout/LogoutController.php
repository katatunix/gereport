<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 3:54 PM
 */

namespace gereport\logout;

use gereport\Config;
use gereport\index\IndexRouter;
use gereport\Redirector;
use gereport\Session;

class LogoutController
{
	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var Config
	 */
	private $config;

	public function __construct($session, $config)
	{
		$this->session = $session;
		$this->config = $config;
	}

	public function process()
	{
		$this->session->clearLogin();
		$indexUrl = (new IndexRouter($this->config->rootUrl()))->url();
		(new Redirector($indexUrl))->redirect();
	}
}
