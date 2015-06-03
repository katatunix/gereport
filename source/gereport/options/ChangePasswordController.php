<?php

namespace gereport\options;

use gereport\decorator\MainLayoutController;
use gereport\View;

class ChangePasswordController extends MainLayoutController
{
	/**
	 * @var ChangePasswordRequest
	 */
	private $request;

	public function __construct($cpassRequest, $session, $factory)
	{
		parent::__construct($session, $factory);
		$this->request = $cpassRequest;
	}

	/**
	 * @return View
	 */
	protected function createContentView()
	{
		if (!$this->session->hasLogged())
		{
			return $this->factory->view()->error403();
		}

		$success = true;
		$message = null;

		$old = null;
		$new = null;
		$confirm = null;

		if ($this->request->isPostMethod())
		{
			$old = $this->request->oldPassword();
			$new = $this->request->newPassword();
			$confirm = $this->request->confirmPassword();
			try
			{
				$this->handle($old, $new, $confirm);
				$success = true;
				$message = 'Password was changed OK';
			}
			catch (\Exception $ex)
			{
				$success = false;
				$message = $ex->getMessage();
			}
		}

		return $this->factory->view()->changePassword($success, $message);
	}

	private function handle($old, $new, $confirm)
	{
		if (!$old)
		{
			throw new \Exception('The current password must not be empty!');
		}
		if (!$new)
		{
			throw new \Exception('The new password must not be empty!');
		}
		if (!$confirm)
		{
			throw new \Exception('The confirm password must not be empty!');
		}
		if ($new != $confirm)
		{
			throw new \Exception('The current and confirm password are not matched!');
		}

		$memberId = $this->session->loggedMemberId();
		$memberDao = $this->factory->dao()->member();

		$member = $memberDao->findById($memberId);

		if (!$member->hasPassword($old))
		{
			throw new \Exception('The current password is wrong!');
		}

		$member->changePassword($new);
	}
}
