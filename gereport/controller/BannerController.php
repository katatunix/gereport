<?php

namespace gereport\controller;

__import('controller/controller');
__import('transaction/GetUsernameTransaction');
__import('view/BannerView');

use gereport\transaction\GetUsernameTransaction;
use gereport\view\BannerView;

class BannerController extends Controller
{

	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		$bannerView = new BannerView($this->toolbox->urlSource, $this->toolbox->htmlDir);

		if ($this->toolbox->session->isLogged())
		{
			$tx = new GetUsernameTransaction($this->toolbox->session->getLoggedMemberId(), $this->toolbox->database);
			try
			{
				$tx->execute();
			}
			catch (\Exception $ex)
			{
				// WTF: logged, but the member id is not found in database??? ===> Logout
				$this->toolbox->redirector->toLogout();
			}
			$bannerView->setUsername( $tx->getMemberUsername() );
		}
		return $bannerView;
	}

}
