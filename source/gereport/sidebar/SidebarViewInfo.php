<?php
/**
 * Created by PhpStorm.
 * User: nghia.buivan
 * Date: 6/5/2015
 * Time: 2:20 PM
 */

namespace gereport\sidebar;


interface SidebarViewInfo
{
	/**
	 * @return array
	 */
	public function projects(); // 'name', 'url'
}
