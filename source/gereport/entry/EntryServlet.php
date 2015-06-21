<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/22/2015
 * Time: 12:49 AM
 */

namespace gereport\entry;


use gereport\Component;
use gereport\MainServlet;

class EntryServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new EntryComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
