<?php

namespace gereport\domain;

interface Report
{
	public function id();
	public function content();
	public function datetimeAdd();
	public function memberUsername();
	public function isVisitor();
	public function canBeManuplatedByMember($memberId);

	public function update($content);
}
