<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 6:08 PM
 */

namespace gereport\options;

use gereport\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{
	/**
	 * @var ChangePasswordRouter
	 */
	private $router;

	public function __construct($request, $router)
	{
		parent::__construct($request);
		$this->router = $router;
	}

	public function oldPassword()
	{
		return $this->request->valuePost($this->router->oldPasswordKey());
	}

	public function newPassword()
	{
		return $this->request->valuePost($this->router->newPasswordKey());
	}

	public function confirmPassword()
	{
		return $this->request->valuePost($this->router->confirmPasswordKey());
	}
}
