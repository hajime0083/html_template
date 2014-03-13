<?php

class BaseAdminController extends Controller {
	
	var $login			= FALSE;
	public $layout		='template.adminbase';
	
	public function __construct() {
		 $this->login = Auth::check();
	}
	
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
			$this->layout->login = $this->login;
		}
	}

}