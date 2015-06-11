<?php

namespace gereport\cpass;

use gereport\Config;
use gereport\domain\MemberDao;
use gereport\Controller;
use gereport\error\Error403View;
use gereport\Session;
use gereport\View;

class CpassController implements Controller, CpassViewInfo
{
	/**
	 * @var CpassRequest
	 */
	private $request;

	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var MemberDao
	 */
	private $memberDao;

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var CpassRouter
	 */
	private $router;

	private $success, $message;

	public function __construct($request, $session, $memberDao, $config, $router)
	{
		$this->request = $request;
		$this->session = $session;
		$this->memberDao = $memberDao;
		$this->config = $config;
		$this->router = $router;
	}

	/**
	 * @return View
	 */
	public function process()
	{
		if (!$this->session->hasLogged()) return new Error403View($this->config);

		$this->success = true;
		$this->message = null;

		if ($this->request->isPostMethod())
		{
			try
			{
				$this->memberDao->findById( $this->session->loggedMemberId() )->changePassword(
					$this->request->oldPassword(),
					$this->request->newPassword(),
					$this->request->confirmPassword()
				);
				$this->success = true;
				$this->message = 'The password has been changed OK';
			}
			catch (\Exception $ex)
			{
				$this->success = false;
				$this->message = $ex->getMessage();
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
