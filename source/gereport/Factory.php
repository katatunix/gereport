<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/2/2015
 * Time: 11:25 PM
 */

namespace gereport;


class Factory
{
	private $daoF;
	private $viewF;
	private $routerF;

	public function __construct($daoF, $viewF, $routerF)
	{
		$this->daoF = $daoF;
		$this->viewF = $viewF;
		$this->routerF = $routerF;
	}

	/**
	 * @return DaoFactory
	 */
	public function dao()
	{
		return $this->daoF;
	}

	/**
	 * @return ViewFactory
	 */
	public function view()
	{
		return $this->viewF;
	}

	/**
	 * @return RouterFactory
	 */
	public function router()
	{
		return $this->routerF;
	}
}
