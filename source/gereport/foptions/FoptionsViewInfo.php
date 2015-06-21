<?php

namespace gereport\foptions;

interface FoptionsViewInfo
{
	public function folderNameKey();
	public function folderName();

	public function actionKey();
	public function actionAddValue();
	public function actionRenameValue();
	public function actionDeleteValue();
}
