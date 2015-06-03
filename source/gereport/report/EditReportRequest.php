<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/3/2015
 * Time: 6:26 PM
 */

namespace gereport\report;


use gereport\BaseRequest;

class EditReportRequest extends BaseRequest
{
	/**
	 * @var EditReportRouter
	 */
	private $router;

	public function __construct($request, $router)
	{
		parent::__construct($request);
		$this->router = $router;
	}

	public function reportId()
	{
		return $this->request->valueGet($this->router->reportIdKey());
	}

	public function nextUrl()
	{
		return $this->request->valueGet($this->router->nextUrlKey());
	}

	public function content()
	{
		return $this->request->valuePost($this->router->contentKey());
	}
}
