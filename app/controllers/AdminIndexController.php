<?php

class AdminIndexController extends BaseAdminController {

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