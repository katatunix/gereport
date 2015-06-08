<?php
/**
 * Created by PhpStorm.
 * User: katat_000
 * Date: 6/5/2015
 * Time: 11:17 PM
 */

namespace gereport\report\edit;

use gereport\Config;
use gereport\domain\ReportDao;
use gereport\error\Error403View;
use gereport\Session;

class EditReportResponse implements EditReportViewInfo
{
	/**
	 * @var EditReportController
	 */
	private $validator;
	/**
	 * @var ReportDao
	 */
	private $reportDao;
	/**
	 * @var Session
	 */
	private $session;

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var EditReportRouter
	 */
	private $router;

	private $content;
	private $success;
	private $message;

	public function __construct($validator, $session, $reportDao, $config, $router)
	{
		$this->validator = $validator;
		$this->reportDao = $reportDao;
		$this->session = $session;
		$this->config = $config;
		$this->router = $router;
	}

	public function execute()
	{
		try
		{
			$this->validator->process();
		}
		catch (\Exception $ex)
		{
			$this->success = false;
			$this->message = $ex->getMessage();
		}

		if ($this->validator->accessDenied())
		{
			return new Error403View($this->config);
		}

		if (!$this->success)
		{
			return new EditReportView($this->config, $this);
		}

		$request = $this->validator->request();

		//$redirector = new Redirector($request->nextUrl());

		$error = false;
		$message = 'The report has been saved';

		try
		{
			$this->reportDao->edit($request->reportId(), $request->content(), $this->validator->datetime());
		}
		catch (\Exception $ex)
		{
			$error = true;
			$message = $ex->getMessage();
		}

		$this->session->saveMessage($message, $error);
		$redirector->redirect();
	}

	public function success()
	{
		return $this->success;
	}

	public function message()
	{
		return $this->message;
	}

	public function content()
	{
		return $this->content;
	}

	public function contentKey()
	{
		return $this->router->contentKey();
	}
}
