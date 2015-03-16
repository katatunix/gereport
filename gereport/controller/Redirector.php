<?php

namespace gereport\controller;

interface Redirector
{
	public function toIndex();
	public function toLogout();
	public function to($url);
}