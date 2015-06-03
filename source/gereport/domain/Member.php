<?php

namespace gereport\domain;

interface Member
{
	const ADMIN	= 0;
	const MOD	= 1;
	const USER	= 2;

	public function username();

	public function hasPassword($password);

	public function changePassword($newPassword);
}
