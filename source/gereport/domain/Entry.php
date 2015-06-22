<?php

namespace gereport\domain;

interface Entry
{
	public function id();
	public function title();
	public function content();

	public function authorUsername();
	public function createdTime();

	public function lastEditorUsername();
	public function lastEditedTime();

	public function canBeManuplatedByMember($memberId);

	public function update($title, $content, $editorId);

	public function folderId();
}
