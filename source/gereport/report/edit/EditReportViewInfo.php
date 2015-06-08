<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/6/2015
 * Time: 12:03 PM
 */

namespace gereport\report\edit;


interface EditReportViewInfo
{
	public function success();
	public function message();

	public function content();
	public function contentKey();
}
