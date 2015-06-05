<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 6:57 PM
 */

namespace gereport\cpass;


interface CpassViewInfo
{
	public function success();
	public function message();

	public function oldKey();
	public function newKey();
	public function confirmKey();
}
