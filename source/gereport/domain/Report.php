<?php

namespace gereport\domain;

interface Report
{
	public function content();
	public function datetimeAdd();
	public function memberUsername();
	public function isPast();

	public function update($content, $datetime);
}
