<?php

class UserIndexController extends UserBaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	/* getIndex
	 * インデックス
	 */
	public function getIndex()
	{
		// INDEXのみ画像を設定
		$this->layout->main_img = 'http://cambelt.co/800x200';
		$this->layout->pagename	= 'INDEX';
		
		// 更新履歴の取得
		
		// BLOGから最新の1件を取得
		
		// LINK一覧を取得
		
		// データのセット
		$data = array(
			
		);
		
		$this->layout->nest('content','user.index',$data);
	}

}