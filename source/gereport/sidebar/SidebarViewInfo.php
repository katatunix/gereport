<?php

namespace gereport\sidebar;

interface SidebarViewInfo
{
	/**
	 * @return array
	 */
	public function tree();

	public function currentUrl();
}
