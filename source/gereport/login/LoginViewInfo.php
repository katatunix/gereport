<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 1:21 PM
 */

namespace gereport\login;


interface LoginViewInfo
{
	public function username();
	public function message();
	public function usernameKey();
	public function passwordKey();
}
