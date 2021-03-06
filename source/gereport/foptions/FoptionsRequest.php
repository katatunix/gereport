<?php

namespace gereport\foptions;

use gereport\BaseRequest;
use gereport\router\FoptionsRouter;

class FoptionsRequest extends BaseRequest
{
	/**
	 * @var FoptionsRouter
	 */
	private $router;

	public function __construct($httpRequest, $router)
	{
		parent::__construct($httpRequest);
		$this->router = $router;
	}

	public function folderId()
	{
		return $this->httpRequest->valueGet($this->router->folderIdKey());
	}

	public function isAdd()
	{
		return $this->actionValue() == $this->router->actionAddValue();
	}

	public function isRename()
	{
		return $this->actionValue() == $this->router->actionRenameValue();
	}

	public function isDelete()
	{
		return $this->actionValue() == $this->router->actionDeleteValue();
	}

	private function actionValue()
	{
		return $this->httpRequest->valuePost( $this->router->actionKey() );
	}

	public function folderName()
	{
		return $this->httpRequest->valuePost( $this->router->folderNameKey() );
	}
}
