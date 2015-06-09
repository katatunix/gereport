<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/9/2015
 * Time: 3:58 PM
 */

namespace gereport\entry;


interface AddEntryViewInfo
{
	public function title();
	public function content();

	public function titleKey();
	public function contentKey();

	public function message();
}
