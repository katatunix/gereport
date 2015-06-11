<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:41 PM
 */

namespace gereport\entry\edit;


interface EditEntryViewInfo
{
	public function title();
	public function content();

	public function titleKey();
	public function contentKey();

	public function message();
	public function success();

	public function breadcrumb();
	public function entryUrl();
}
