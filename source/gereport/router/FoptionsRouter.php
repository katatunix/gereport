<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/19/2015
 * Time: 10:24 AM
 */

namespace gereport\router;


use gereport\Router;

class FoptionsRouter extends Router
{
	const ROUTER = 'foptions';

	public function folderIdKey()
	{
		return 'f';
	}

	public function actionKey()
	{
		return 'action';
	}

	public function actionAddValue()
	{
		return 'add';
	}

	public function actionRenameValue()
	{
		return 'rename';
	}

	public function actionDeleteValue()
	{
		return 'delete';
	}

	public function folderNameKey()
	{
		return 'name';
	}

	public function url($folderId)
	{
		return $this->rootUrl . self::ROUTER . '?' . $this->folderIdKey() . '=' . $folderId;
	}
}
