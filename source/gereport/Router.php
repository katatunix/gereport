<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/2/2015
 * Time: 11:31 PM
 */

namespace gereport;


class Router
{
	protected $rootUrl;
	/**
	 * @var Redirector
	 */
	private $redirector;

	public function __construct($rootUrl, $redirector)
	{
		$this->rootUrl = $rootUrl;
		$this->redirector = $redirector;
	}

	protected function redirectTo($url)
	{
		$this->redirector->redirect($url);
	}
}
