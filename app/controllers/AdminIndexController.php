<?php

class AdminIndexController extends BaseAdminController {
	
	/* getIndex
	 * インデックス
	 */
	public function getIndex()
	{
		// 未読処理の取得
		
		// データのセット
		$data = array(
			
		);
		
		$this->layout->nest('content','admin.index',$data);
	}
	
	/* getLogin
	 * ログイン画面
	 */
	public function getLogin()
	{
		// ログイン済の場合は管理画面TOPにリダイレクト
		if(Auth::check()){
			return Redirect::to('/admin');
		}
		
//		$password = Hash::make('pass');
//		if (Hash::check('pass', $password))
//		{
//			echo "pass OK";
//		}else{
//			echo "pass NG";
//		}
		$this->layout->nest('content','admin.login');
	}
	

	
	/* postIndex
	 * ログイン処理
	 */
	public function postLogin()
	{
		$inputs = Input::only(array('login', 'password'));
		if (Auth::attempt($inputs))
		{
			// ログインできたらリダイレクト
			return Redirect::to('/admin');
		}else{
			Session::flash('message', 'ログインできませんでした');
		}
		
		// データのセット
		$data = array(
			
		);
		
		$this->layout->nest('content','admin.login',$data);
	}
	
	/* getLogout
	 * ログアウト
	 */
	public function getLogout()
	{
		// ログアウト処理
		Auth::logout();
		return Redirect::to('/login');
	}
	
	/* getUser
	 * ユーザー情報管理
	 */
	public function getUser(){
		$loginuser_data = Auth::user();
		// データのセット
		$data = array(
			'login' => $loginuser_data->login,
			'name' => $loginuser_data->name,
			'mail' => $loginuser_data->mail,
		);
		$this->layout->nest('content','admin.user_index',$data);
	}
	
	/* postUser
	 * ユーザー情報管理
	 */
	public function postUser(){
		
		// バリデーション
		$validator = Validator::make(
			array(
				'name' => 'Dayle',
				'password' => 'lamepassword',
				'email' => 'email@example.com'
			),
			array(
				'name' => 'required',
				'password' => 'required|min:8',
				'email' => 'required|email|unique:users'
			)
		);

		// データのセット
		$data = array(
			
		);
		$this->layout->nest('content','admin.user_index',$data);
		
	}
}