<?php

class AdminIndexController extends BaseAdminController {

	/* getLogin
	 * ログイン画面
	 */
	public function getLogin()
	{
		// データのセット
		$data = array(
			
		);
		
		$this->layout->nest('content','admin.login',$data);
	}
	
	/* getIndex
	 * インデックス
	 */
	public function getIndex()
	{
		// データのセット
		$data = array(
			
		);
		
		$this->layout->nest('content','admin.index',$data);
	}
}