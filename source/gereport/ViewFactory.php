<?php

namespace gereport;

use gereport\authen\LoginView;
use gereport\decorator\BannerView;
use gereport\decorator\FooterView;
use gereport\decorator\MainLayoutView;
use gereport\decorator\SidebarView;
use gereport\index\IndexView;
use gereport\options\ChangePasswordView;
use gereport\post\AddPostView;

class ViewFactory
{
	protected $htmlDirPath, $htmlDirUrl;

	public function __construct($htmlDirPath, $htmlDirUrl)
	{
		$this->htmlDirPath = $htmlDirPath;
		$this->htmlDirUrl = $htmlDirUrl;
	}

	/**
	 * @return IndexView
	 */
	public function index()
	{
		return new IndexView($this->htmlDirPath, $this->htmlDirUrl);
	}

	/**
	 * @param $banner
	 * @param $footer
	 * @param $sidebar
	 * @param $content
	 * @return MainLayoutView
	 */
	public function mainLayout($banner, $footer, $sidebar, $content)
	{
		return new MainLayoutView($this->htmlDirPath, $this->htmlDirUrl, $banner, $footer, $sidebar, $content);
	}

	/**
	 * @param $username
	 * @param $message
	 * @param $usernameKey
	 * @param $passwordKey
	 * @return LoginView
	 */
	public function login($username, $message, $usernameKey, $passwordKey)
	{
		return new LoginView($this->htmlDirPath, $this->htmlDirUrl, $username, $message, $usernameKey, $passwordKey);
	}

	/**
	 * @return AddPostView
	 */
	public function addPost()
	{

	}

	/**
	 * @return ChangePasswordView
	 */
	public function changePassword()
	{

	}

	/**
	 * @param $username
	 * @return BannerView
	 */
	public function banner($username)
	{
	}

	/**
	 * @return FooterView
	 */
	public function footer()
	{
	}

	/**
	 * @param $projects
	 * @return SidebarView
	 */
	public function sidebar($projects)
	{
	}

}
