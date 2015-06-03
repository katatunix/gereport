<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 5:36 PM
 */

namespace gereport\report;


use gereport\BaseRequest;

class AddReportRequest extends BaseRequest
{
	/**
	 * @var AddReportRouter
	 */
	private $router;

	public function __construct($request, $router)
	{
		parent::__construct($request);
		$this->router = $router;
	}

	public function content()
	{
		return $this->request->valuePost($this->router->contentKey());
	}

	public function projectId()
	{
		return $this->request->valuePost($this->router->projectIdKey());
	}

	public function dateFor()
	{
		return $this->request->valuePost($this->router->dateForKey());
	}

	public function nextUrl()
	{
		return $this->request->valuePost($this->router->nextUrlKey());
	}
}
