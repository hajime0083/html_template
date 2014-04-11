<?php

class UserBaseController extends Controller {
	
	public $layout='template.base';

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
			// テンプレートへのデータセット
			$this->layout->main_img	= FALSE;
			$this->layout->sitename	= Config::get('my_config.sitename');
			$this->layout->since_start	= '2009';
			$this->layout->js		= '';
			$this->layout->css	= '';
		}
	}

}