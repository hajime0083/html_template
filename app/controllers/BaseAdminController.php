<?php

class BaseAdminController extends Controller {
	
	public function __construct() {
		$controllername = Request::controller()->controller;
		if(Auth::guest()){
			// 未ログイン時
		}
	}
	
	public $layout='template.adminbase';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}