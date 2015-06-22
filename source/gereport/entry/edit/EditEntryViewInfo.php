<?php

namespace gereport\entry\edit;

interface EditEntryViewInfo
{
	public function title();
	public function content();

	public function titleKey();
	public function contentKey();

	public function message();
	public function success();

	public function entryUrl();

	public function isSaveAndViewKey();
}
