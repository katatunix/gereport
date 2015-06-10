<?php

namespace gereport\domain;

interface Project
{
	public function id();
	public function name();

	/**
	 * @param $memberId
	 * @return bool
	 */
	public function hasMember($memberId);
}
