<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 6:27 PM
 */

namespace gereport\entry;


interface EntryViewInfo
{
	public function content();
	public function breadcrumb();

	public function author();
	public function createdTime();

	public function editor();
	public function editedTime();

	public function canBeManupaled();
	public function editUrl();
}
