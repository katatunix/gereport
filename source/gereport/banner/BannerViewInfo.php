<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:05 PM
 */

namespace gereport\banner;


interface BannerViewInfo
{
	public function loggedMemberUsername();
	public function currentUrl();
	public function indexUrl();
	public function optionsUrl();
	public function loginUrl();
	public function logoutUrl();
}
