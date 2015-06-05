<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 6:08 PM
 */

namespace gereport\cpass;

use gereport\BaseRequest;

class CpassRequest extends BaseRequest
{
	/**
	 * @var CpassRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function oldPassword()
	{
		return $this->httpRequest->valuePost($this->router->oldPasswordKey());
	}

	public function newPassword()
	{
		return $this->httpRequest->valuePost($this->router->newPasswordKey());
	}

	public function confirmPassword()
	{
		return $this->httpRequest->valuePost($this->router->confirmPasswordKey());
	}
}
