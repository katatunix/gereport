<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 7:04 PM
 */

namespace gereport\cpass;

use gereport\Config;
use gereport\domain\MemberDao;
use gereport\error\Error403View;
use gereport\View;

class CpassResponse implements CpassViewInfo
{
	/**
	 * @var CpassValidator
	 */
	private $validator;
	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var CpassRouter
	 */
	private $router;

	/**
	 * @var MemberDao
	 */
	private $memberDao;

	private $success;
	private $message;

	public function __construct($validator, $memberDao, $config, $router)
	{
		$this->validator = $validator;
		$this->config = $config;
		$this->router = $router;
		$this->memberDao = $memberDao;
	}

	/**
	 * @return View
	 */
	public function execute()
	{
		$errorMessage = null;
		try
		{
			$this->validator->validate();
		}
		catch (\Exception $ex)
		{
			$errorMessage = $ex->getMessage();
		}

		if ($this->validator->accessDenied())
		{
			return new Error403View($this->config);
		}

		if (!$this->validator->isShowingViewOnly())
		{
			if ($errorMessage)
			{
				$this->success = false;
				$this->message = $errorMessage;
			}
			else
			{
				$this->memberDao->findById($this->validator->memberId())->changePassword(
					$this->validator->newPassword()
				);
				$this->success = true;
				$this->message = 'Password was changed OK';
			}
		}

		return new CpassView($this->config, $this);
	}

	public function success()
	{
		return $this->success;
	}

	public function message()
	{
		return $this->message;
	}

	public function oldKey()
	{
		return $this->router->oldPasswordKey();
	}

	public function newKey()
	{
		return $this->router->newPasswordKey();
	}

	public function confirmKey()
	{
		return $this->router->confirmPasswordKey();
	}
}
