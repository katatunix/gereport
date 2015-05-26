<?php

namespace gereport\controller;

__import('controller/Controller');
__import('transaction/LoginTransaction');
__import('view/LoginView');
__import('session/Session');

use gereport\session\Session;
use gereport\transaction\LoginTransaction;
use gereport\view\LoginView;

class LoginController extends Controller
{

	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		$request = $this->toolbox->request;
		$loginView = new LoginView($this->toolbox->urlSource, $this->toolbox->htmlDir);

		if ($request->isPostMethod())
		{
			$username = $request->getDataPost('username');
			$password = $request->getDataPost('password');

			$transaction = new LoginTransaction($username, $password, $this->toolbox->database);
			$transaction->execute();

			$loggedMemberId = $transaction->getLoggedMemberId();

			if ($loggedMemberId > Session::NO_MEMBER_ID)
			{
				$this->toolbox->session->setLoggedMemberId($loggedMemberId);
				$this->toolbox->redirector->toIndex();
			}
			else
			{
				$loginView->setMessage('Login failed!')->setUsername($username);
			}
		}

		$loginView->setTitle('Login to the Hell');
		return $loginView;
	}

}
