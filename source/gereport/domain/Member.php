<?php

namespace gereport\domain;

interface Member
{
	const ADMIN	= 0;
	const MOD	= 1;
	const USER	= 2;

	public function id();
	public function username();
	public function changePassword($old, $new, $confirm);
}
