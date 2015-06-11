<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 5:08 PM
 */

namespace gereport\entry;

use gereport\index\IndexRouter;
use gereport\projecthome\ProjectHomeRouter;

class Breadcrumb
{
	public function make($projectId, $projectName, $rootUrl)
	{
		$breads = array();

		$homeUrl = (new IndexRouter($rootUrl))->url();

		if (!$projectId)
		{
			$breads[] = array('Home', $homeUrl);
			$breads[] = array('Diary', $homeUrl);
		}
		else
		{
			$projectUrl = (new ProjectHomeRouter($rootUrl))->url($projectId);
			$diaryUrl = (new DiaryRouter($rootUrl))->url($projectId);
			$breads[] = array($projectName, $projectUrl);
			$breads[] = array('Diary', $diaryUrl);
		}

		return $breads;
	}
}
