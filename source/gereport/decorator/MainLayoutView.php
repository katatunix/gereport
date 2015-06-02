<?php

namespace gereport\decorator;

__import('gereport/View');

use gereport\View;

class MainLayoutView extends View
{
	/**
	 * @var View
	 */
	protected $contentView;
	protected $bannerView;
	protected $footerView;
	protected $sidebarView;

	public function __construct($config, $bannerView, $footerView, $sidebarView, $contentView)
	{
		parent::__construct($config);

		$this->contentView = $contentView;
		$this->bannerView = $bannerView;
		$this->footerView = $footerView;
		$this->sidebarView = $sidebarView;

		$this->title = $this->contentView->title();
	}

	protected function htmlFileName()
	{
		return 'MainLayoutHtml.php';
	}
}
