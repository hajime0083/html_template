<?php

class AdminBlogController extends BaseAdminController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex()
	{
		
		// 過去記事の一覧を取得
		
		
		// データのセット
		$data = array(
			
		);
		$this->layout->nest('content','admin.blog_index',$data);
	}
	
	/* getEdit
	 * 新規登録OR修正
	 */
	public function getEdit($id = NULL)
	{
		$h2 = "更新";
		if(is_null($id)){
			// 新規登録
			$h2 = "新規";
		}
		// 修正の場合
		
		
		// データのセット
		$data = array(
			'h2' => $h2,
		);
		$this->layout->nest('content','admin.blog_edit',$data);
	}

}