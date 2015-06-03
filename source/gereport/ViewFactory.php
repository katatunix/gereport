<?php

namespace gereport;

use gereport\authen\LoginView;
use gereport\decorator\BannerView;
use gereport\decorator\Error403View;
use gereport\decorator\Error404View;
use gereport\decorator\FooterView;
use gereport\decorator\MainLayoutView;
use gereport\decorator\SidebarView;
use gereport\index\IndexView;
use gereport\options\ChangePasswordView;
use gereport\options\OptionsView;
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
		// TODO
	}

	/**
	 * @param $success
	 * @param $message
	 * @return ChangePasswordView
	 */
	public function changePassword($success, $message)
	{
		return new ChangePasswordView($this->htmlDirPath, $this->htmlDirUrl, $success, $message);
	}

	/**
	 * @param $username
	 * @param $indexUrl
	 * @param $optionsUrl
	 * @param $loginUrl
	 * @param $logoutUrl
	 * @return BannerView
	 */
	public function banner($username, $indexUrl, $optionsUrl, $loginUrl, $logoutUrl)
	{
		return new BannerView($this->htmlDirPath, $this->htmlDirUrl, $username,
			$indexUrl, $optionsUrl, $loginUrl, $logoutUrl);
	}

	/**
	 * @return FooterView
	 */
	public function footer()
	{
		return new FooterView($this->htmlDirPath, $this->htmlDirUrl);
	}

	/**
	 * @param $projects
	 * @return SidebarView
	 */
	public function sidebar($projects)
	{
		return new SidebarView($this->htmlDirPath, $this->htmlDirUrl, $projects);
	}

	/**
	 * @return Error404View
	 */
	public function error404()
	{
		return new Error404View($this->htmlDirPath, $this->htmlDirUrl);
	}

	/**
	 * @return Error403View
	 */
	public function error403()
	{
		return new Error403View($this->htmlDirPath, $this->htmlDirUrl);
	}

	/**
	 * @param $cpassUrl
	 * @return OptionsView
	 */
	public function options($cpassUrl)
	{
		return new OptionsView($this->htmlDirPath, $this->htmlDirUrl, $cpassUrl);
	}

}
