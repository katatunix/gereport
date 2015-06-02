<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/2/2015
 * Time: 6:08 PM
 */

namespace gereport\options;

use gereport\Request;

class ChangePasswordRequest extends Request
{
	/**
	 * @var ChangePasswordRouter
	 */
	private $router;

	public function __construct($router)
	{
		parent::__construct();
		$this->router = $router;
	}

	public function oldPassword()
	{
		return $this->valuePost($this->router->oldPasswordKey());
	}

	public function newPassword()
	{
		return $this->valuePost($this->router->newPasswordKey());
	}

	public function confirmPassword()
	{
		return $this->valuePost($this->router->confirmPasswordKey());
	}
}
