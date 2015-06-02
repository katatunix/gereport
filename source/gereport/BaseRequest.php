<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/2/2015
 * Time: 11:52 PM
 */

namespace gereport;


class BaseRequest
{
	/**
	 * @var Request
	 */
	protected $request;

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function isPostMethod()
	{
		return $this->request->isPostMethod();
	}
}
