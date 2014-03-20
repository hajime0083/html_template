<?php

class AdminIndexController extends AdminBaseController {
	
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
		
		return Redirect::back();
		
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
		$this->layout->nest('content','admin.user.edit',$data);
	}
	
	/* postUser
	 * ユーザー情報管理
	 */
	public function postUser(){
		
		// 値取得
		$inputs = Input::all();
		$user_id = Auth::user()->id;
		
		// バリデーション
		$validator = Validator::make(
			$inputs,
			array(
				'name'		=> 'required',
				'login'		=> "required|min:4|max:8|unique:users,login,{$user_id}",
				'pass'		=> 'min:4|max:16|confirmed',
				'mail'		=> "required|email|max:50|unique:users,mail,{$user_id}",
			)
		);
		
		if($validator->fails())
		{
			// エラーメッセージのセット
			$messages = $validator->errors()->all();
			$errormes = '';
			for($i=0;$i<count($messages);$i++){
				if(!empty($errormes)){
					$errormes .= '<br />';
				}
				$errormes .= $messages[$i];
			}
			Session::flash('message',$errormes);
		}
		else
		{
			$insert_data = array(
				'name' => $inputs['name'],
				'login' => $inputs['login'],
				'mail' => $inputs['mail'],
			);
			if(!empty($inputs['pass'])){
				// 新しいパスワード設定時
				$insert_data['pass'] = Hash::make($inputs['pass']);
			}
			
			try{
				DB::beginTransaction();
				// 更新
				$User = User::find($user_id);
				foreach($insert_data as $insert_key => $insert_value){
					$User->{$insert_key} = $insert_value;
				}
				$User->save();
				
				DB::commit();
				Session::flash('message','更新が完了しました');
			}catch(Exception $e){
				DB::rollback();
				Session::flash('message','更新出来ませんでした');
			}
		}
		
		return Redirect::to('/admin/user')->withInput();
		
	}
}