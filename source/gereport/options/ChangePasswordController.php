<?php

namespace gereport\options;

use gereport\decorator\Error403View;
use gereport\decorator\MainLayoutController;
use gereport\mysqldomain\MySqlMemberDao;
use gereport\View;

class ChangePasswordController extends MainLayoutController
{
	/**
	 * @return View
	 */
	protected function createContentView()
	{
		if (!$this->session->hasLogged())
		{
			return new Error403View($this->config);
		}

		$error = false;
		$message = null;
		$router = new ChangePasswordRouter();
		$request = new ChangePasswordRequest($router);

		$old = null;
		$new = null;
		$confirm = null;

		if ($request->isPostMethod())
		{
			$old = $request->oldPassword();
			$new = $request->newPassword();
			$confirm = $request->confirmPassword();
			try
			{
				$this->handle($old, $new, $confirm);
				$error = false;
				$message = 'Password was changed OK';
			}
			catch (\Exception $ex)
			{
				$error = true;
				$message = $ex->getMessage();
			}
		}

		return new ChangePasswordView($this->config, $error, $message, $router);
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

		$memberDao = new MySqlMemberDao();
		$member = $memberDao->findById( $this->session->loggedMemberId() );

		if (!$member)
		{
			throw new \Exception('The member is not existed!');
		}

		if (!$member->hasPassword($old))
		{
			throw new \Exception('The current password is wrong!');
		}

		$member->changePassword($new);
	}
}
