<?php

namespace gereport\controller;

/**
 * A controller gets inputs from a request, executes transactions, and then return a view.
 * In some cases, a controller might redirect to another URL by using the $toolbox->redirector.
 */

abstract class Controller
{
	/**
	 * @var Toolbox
	 */
	protected $toolbox;

	public function __construct($toolbox)
	{
		$this->toolbox = $toolbox;
	}

	/**
	 * @return View
	 */
	public abstract function process();
}
