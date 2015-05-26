<?php

namespace gereport\controller;

__import('controller/controller');
__import('view/OptionsView');

use gereport\view\Error403View;
use gereport\view\OptionsView;

class OptionsController extends Controller
{
	public function __construct($toolbox)
	{
		parent::__construct($toolbox);
	}

	public function process()
	{
		if (!$this->toolbox->session->isLogged())
		{
			return new Error403View($this->toolbox->urlSource, $this->toolbox->htmlDir);
		}

		$optionsView = new OptionsView($this->toolbox->urlSource, $this->toolbox->htmlDir);

		$optionsView->setTitle('Options');

		return $optionsView;
	}
}
