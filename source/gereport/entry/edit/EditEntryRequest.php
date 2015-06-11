<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:29 PM
 */

namespace gereport\entry\edit;


use gereport\BaseRequest;

class EditEntryRequest extends BaseRequest
{
	/**
	 * @var EditEntryRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function entryId()
	{
		return $this->httpRequest->valueGet($this->router->entryIdKey());
	}

	public function title()
	{
		return $this->httpRequest->valuePost($this->router->titleKey());
	}

	public function content()
	{
		return $this->httpRequest->valuePost($this->router->contentKey());
	}

}
