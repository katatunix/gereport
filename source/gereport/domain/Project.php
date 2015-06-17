<?php

namespace gereport\domain;

interface Project
{
	public function id();
	public function name();
	public function hasMember($memberId);

	/**
	 * @return Folder
	 */
	public function folder();
}
