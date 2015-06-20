<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/11/2015
 * Time: 2:27 PM
 */

namespace gereport\router;


use gereport\Router;

class EditEntryRouter extends Router
{
	const ROUTER = 'entry/edit';

	public function entryIdKey()
	{
		return 'id';
	}

	public function titleKey()
	{
		return 'title';
	}

	public function contentKey()
	{
		return 'content';
	}

	public function url($entryId)
	{
		return $this->rootUrl . self::ROUTER . '?' . $this->entryIdKey() . '=' . $entryId;
	}
}
