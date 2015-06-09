<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 6:16 PM
 */

namespace gereport\options;

use gereport\Config;
use gereport\Controller;
use gereport\error\Error403View;
use gereport\Session;
use gereport\View;

class OptionsController implements Controller
{
	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var Config
	 */
	private $config;

	private $cpassUrl;

	public function __construct($session, $config, $cpassUrl)
	{
		$this->session = $session;
		$this->config = $config;
		$this->cpassUrl = $cpassUrl;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged())
		{
			return new Error403View($this->config);
		}
		return new OptionsView($this->config, $this->cpassUrl);
	}
}
