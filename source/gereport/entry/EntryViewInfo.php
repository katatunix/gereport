<?php

namespace gereport\entry;

interface EntryViewInfo
{
	public function title();
	public function content();

	public function authorUsername();
	public function createdTime();

	public function lastEditorUsername();
	public function lastEditedTime();

	public function editEntryUrl();

	public function canBeManuplated();
}
