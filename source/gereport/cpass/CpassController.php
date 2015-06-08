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
		if (!$this->session->hasLogged())
		{
			return new Error403View($this->config);
		}

		$this->success = false;
		$this->message = null;

		if ($this->request->isPostMethod())
		{
			$old = $this->request->oldPassword();
			if (!$old)
			{
				$this->message = 'The current password is empty';
				goto my_end;
			}

			$member = null;
			try
			{
				$member = $this->memberDao->findById( $this->session->loggedMemberId() );
				if (!$member->hasPassword($old))
				{
					$this->message = 'The current password is wrong';
					goto my_end;
				}
				$new = $this->request->newPassword();
				$confirm = $this->request->confirmPassword();
				if ($new != $confirm)
				{
					$this->message = 'The new and confirm passwords are not matched';
					goto my_end;
				}
				$member->changePassword($new);
				$this->success = true;
				$this->message = 'The password has been changed OK';
			}
			catch (\Exception $ex)
			{
				$this->message = $ex->getMessage();
				goto my_end;
			}

			my_end:
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
