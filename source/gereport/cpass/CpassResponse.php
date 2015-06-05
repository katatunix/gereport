<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 7:04 PM
 */

namespace gereport\cpass;


use gereport\Config;
use gereport\error\Error403View;
use gereport\View;

class CpassResponse implements CpassViewInfo
{
	/**
	 * @var CpassProcessor
	 */
	private $processor;
	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var CpassRouter
	 */
	private $router;

	public function __construct($processor, $config, $router)
	{
		$this->processor = $processor;
		$this->config = $config;
		$this->router = $router;
	}

	/**
	 * @return View
	 */
	public function execute()
	{
		$this->processor->process();

		if ($this->processor->accessDenied())
		{
			return new Error403View($this->config);
		}

		return new CpassView($this->config, $this);
	}

	public function success()
	{
		return $this->processor->success();
	}

	public function message()
	{
		return $this->processor->message();
	}

	public function oldKey()
	{
		return $this->router->oldPasswordKey();
	}

	public function newKey()
	{
		return $this->router->newPasswordKey();
	}

	public function confirmKey()
	{
		return $this->router->confirmPasswordKey();
	}
}
