<?php

namespace gereport\domain;

interface Post
{
	public function id();
	public function title();
	public function content();

	public function authorUsername();
	public function createdTime();

	public function lastEditorUsername();
	public function lastEditedTime();
}
