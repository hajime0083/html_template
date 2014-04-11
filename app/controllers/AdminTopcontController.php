<?php

class AdminTopcontController extends AdminBaseController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex(){
		
		$this->layout->js		.= HTML::script('js/imgLiquid-min.js');
		$this->layout->js		.= HTML::script('js/admin_top.js');
		
		// メインイメージの取得
		$main_img		= FALSE;
		if(File::exists(Config::get('my_config.file_path.main_img'))){
			$main_img	= TRUE;
		}
		// ジャンル一覧の取得
		$query_genre = DB::table('genres')
					->select('id','name')
					->where('genres.active_flg', Genre::ACTIVE_FLG_YES)
					->orderBy('genres.order','ASC');
		try{
			$genre_data = $query_genre->get();
		}catch(Exception $e){
			$genre_data = '';
		}
		$genre_list[NULL] = '--ジャンルを選択して下さい--';
		if(!empty($genre_data)){
			foreach($genre_data as $genre_value){
				$genre_list[$genre_value->id] = $genre_value->name;
			}
		}
		
		// リンク一覧の取得
		$query_link = DB::table('links')
				->select(
						'links.id',
						'links.name as name',
						'links.url',
						'links.genre_id'
						)
				->leftJoin('genres', 'genres.id', '=', 'links.genre_id')
				->orderBy('genres.order','ASC');
		try{
			$link_list = $query_link->get();
		}catch(Exception $e){
			$link_list = '';
		}
		
		// 更新履歴の取得
		if(File::exists(Config::get('my_config.file_path.lastupdate'))){
			// 存在していたらファイルの読み込み
			$files		= File::get(Config::get('my_config.file_path.lastupdate'));
			$filearray	= array_slice(explode("\n", $files),0,Config::get('my_config.lastupdate_num'));
			$lastupdate = implode('',$filearray);
		}else{
			// 存在しなかった場合ファイルの生成
			File::append(Config::get('my_config.file_path.lastupdate'),'');
			$lastupdate = '';
		}

		$data = array(
			'lastupdate' => $lastupdate,
			'main_img'	=> $main_img,
			'genre_list' => $genre_list,
			'link_list' => $link_list,
		);
		$this->layout->nest('content','admin.top.index',$data);
		
	}
	
	public function postIndex(){
		
		$inputs = Input::all();

		
		if($inputs['type'] == 'main_img'){
			// 画像登録
			$filename			= 'main_img.jpg';
			$destinationPath	= Config::get('my_config.img_path.common');
			$main_img			= @$inputs['main_img'];
			// 画像アップロード
			if(!empty($main_img) && !isset($inputs['del_main_img'])){
				// 既存画像削除
				File::delete($destinationPath.$filename);
				$main_img->move($destinationPath, $filename);
			}elseif(isset($inputs['del_main_img'])){
				// 既存画像削除
				File::delete($destinationPath.$filename);
			}
			Session::flash('message', '更新完了しました');
			
		}elseif($inputs['type'] == 'lastupdate'){
			// 更新履歴
			$filearray	= array_slice(explode("\n", trim($inputs['lastupdate'])),0,Config::get('my_config.lastupdate_num'));
			$lastupdate = implode('',$filearray);
			File::put(Config::get('my_config.file_path.lastupdate'), $lastupdate);
		}elseif($inputs['type'] == 'link_add'){
			// リンク追加
			// バリデーション
			$validator = Validator::make($inputs,array(
				'name'			=> "required|max:50",
				'url'			=> "required|max:100",
				'genre_id'		=> "required",
			));
			$valid_name = array(
				'name'			=> "サイト名",
				'url'			=> "サイトアドレス",
				'genre_id'		=> "ジャンル",
			);
			$validator->setAttributeNames($valid_name);
			if($validator->fails()){
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
			}else{
				// 登録処理
				$insert_data = array(
					'name'		=> $inputs['name'],
					'url'		=> $inputs['url'],
					'genre_id'	=> $inputs['genre_id']
				);
				try{
					DB::beginTransaction();
					$link = new Link;
					foreach($insert_data as $insert_key => $insert_value){
						$link->{$insert_key} = $insert_value;
					}
					$link->save();
					DB::commit();
					// 登録完了のメッセージ
					Session::flash('message', '新規リンク追加');
				}catch(Exception $e){
					DB::rollback();
					Session::flash('message', 'リンクを追加できませんでした');
				}
			}
		}elseif($inputs['type'] == 'link_edit'){
			// リンク編集
			
			// 更新
			// バリデーション
			$rules = '';
			foreach(array_keys($inputs['name']) as $name_key){
				$rules["name.$name_key"] = "required|max:15";
				$rules["url.$name_key"] = "required|url|min:0|max:100";
				$rules["genre_id.$name_key"] = "required";
			}
			$validator = Validator::make($inputs,$rules);
			if($validator->fails()){
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
			}else{

				// 登録処理
				$insert_data = '';
				foreach($inputs['name'] as $name_key => $name_value){
					$insert_data[$name_key] = array(
						'name' => $name_value,
						'url' => $inputs['url'][$name_key],
						'genre_id' => $inputs['genre_id'][$name_key]
					);
				}

				if(is_array($insert_data)){
					try{
						DB::beginTransaction();
						foreach($insert_data as $insert_key => $insert_value){
							$genre = Link::find($insert_key);
							if(isset($inputs['del_flg'][$insert_key])){
								$genre->delete();
							}else{
								foreach($insert_value as $insert_value_key => $insert_value_value){
									$genre->{$insert_value_key} = $insert_value_value;
								}
								$genre->save();
							}
						}
						DB::commit();

						// 登録完了のメッセージ
						Session::flash('message', '更新完了');

					}catch(Exception $e){
						DB::rollback();
						Session::flash('message', '更新出来ませんでした');
					}
				}
			}
			
		}

		return Redirect::to('/admin/top/');
		
	}
}