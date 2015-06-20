<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/19/2015
 * Time: 11:56 PM
 */

namespace gereport\index;

use gereport\Component;
use gereport\MainServlet;

class IndexServlet extends MainServlet
{
	/**
	 * @return Component
	 */
	protected function createContentComponent()
	{
		return new IndexComponent($this->httpRequest, $this->session, $this->config, $this->daoFactory);
	}
}
