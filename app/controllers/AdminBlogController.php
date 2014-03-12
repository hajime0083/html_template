<?php

class AdminBlogController extends BaseAdminController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex()
	{
		// データのセット
		$data = array(
			
		);
		
		$this->layout->nest('content','admin.blog',$data);
	}

}