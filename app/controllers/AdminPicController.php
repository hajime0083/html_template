<?php

class AdminPicController extends AdminBaseController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex(){
		
		// コンテンツ一覧を取得
		$illust_query = DB::table('illusts')
					->select(
							'illusts.id',
							'illusts.title',
							'illusts.release_date',
							'genres.name'
							)
					->leftJoin('genres', 'genres.id', '=', 'illusts.genre_id')
					->orderBy('illusts.created_at','DESC');
		try{
			$illust_data = $illust_query->get();
		}catch(Exception $e){
			$illust_data = '';
		}
		
		// データの成型
		$illust_list = '';
		if(!empty($illust_data)){
			foreach($illust_data as $illust_value){
				$novel_list[] = array(
					'id'			=> $illust_value->id,
					'title'			=> $illust_value->title,
					'created_at'	=> date('Y年m月d日',$illust_value->release_date),
					'genre'			=> $illust_value->name,
				);
			}
		}

		// データのセット
		$data = array(
			'illust_list' => $illust_list,
		);
		
		return $this->layout->nest('content','admin.pic.index',$data);
		
	}
	
	public function getEdit($id = NULL){
		// 初期化
		$h2	= '新規';
		$active_flg = Novel::ACTIVE_FLG_YES;
		$release_year	= date('Y');
		$release_month	= date('m');
		$release_day	= date('d');
		$release_hour	= date('H');
		$release_min	= date('i');
		
		if(!empty($id)){
			// 編集
			$query_txt = DB::table('novels')->where('id', $id);
			try{
				$txt_data = $query_txt->first();
			}catch(Exception $e){
				$txt_data = '';
			}

			if(!empty($txt_data)){
				// 本文ファイルの確認
				if(File::exists(Config::get('my_config.file_path.novel').DIRECTORY_SEPARATOR."{$id}.txt")){
					$h2	= '編集';
					// 存在していたら本文の取得
					$note = File::get(Config::get('my_config.file_path.novel').DIRECTORY_SEPARATOR."{$id}.txt");
					foreach($txt_data as $txt_key => $txt_value){
						${$txt_key} = $txt_value;
					}
					$release_year	= date('Y',$txt_data->release_date);
					$release_month	= date('m',$txt_data->release_date);
					$release_day	= date('d',$txt_data->release_date);
					$release_hour	= date('H',$txt_data->release_date);
					$release_min	= date('i',$txt_data->release_date);
				}
			}
		}
		
		// ジャンル一覧の取得
		$query_genre = DB::table('genres')
					->select('id','name')
					->where('genres.active_flg', Genre::ACTIVE_FLG_YES)
					->orderBy('genres.order','ASC');
		
		// シリーズ一覧の取得
		$query_group = DB::table('groups')
					->select('id','name')
					->where('active_flg', Group::ACTIVE_FLG_YES);
		
		try{
			$genre_data = $query_genre->get();
			$group_data = $query_group->get();
		}catch(Exception $e){
			$genre_data = '';
			$group_data = '';
		}
		$genre_list[NULL] = '--ジャンルを選択して下さい--';
		if(!empty($genre_data)){
			foreach($genre_data as $genre_value){
				$genre_list[$genre_value->id] = $genre_value->name;
			}
		}
		$group_list[NULL] = '--シリーズを選択して下さい--';
		if(!empty($group_data)){
			foreach($group_data as $group_value){
				$group_list[$group_value->id] = $group_value->name;
			}
		}
		
		$data = array(
			'h2'			=> $h2,
			'title'			=> @$title,
			'note'			=> @$note,
			'genre_id'		=> @$genre_id,
			'genre_list'	=> $genre_list,
			'r_flg'			=> @$r_flg,
			'cp'			=> @$cp,
			'active_flg'	=> @$active_flg,
			'postscript'	=> @$postscript,
			'description'	=> @$description,
			'group_list'	=> @$group_list,
			'group_id'		=> @$group_id,
			'release_year'	=> @$release_year,
			'release_month'	=> @$release_month,
			'release_day'	=> @$release_day,
			'release_hour'	=> @$release_hour,
			'release_min'	=> @$release_min
		);
		
		
		return $this->layout->nest('content','admin.txt.edit',$data);
	}

	public function postEdit($id = NULL){
		
		$inputs = Input::all();
		
		// 公開日
		if(
			empty($inputs['release_year']) && 
			empty($inputs['release_month']) && 
			empty($inputs['release_day']) && 
			empty($inputs['release_hour']) && 
			empty($inputs['release_min'])	
		){
			$inputs['release_year'] = date('Y');
			$inputs['release_month'] = date('m');
			$inputs['release_day'] = date('d');
			$inputs['release_hour'] = date('H');
			$inputs['release_min'] = date('i');
		}
		if(empty($inputs['release_min'])){
			$inputs['release_min'] = '00';
		}
		if(empty($inputs['release_hour'])){
			$inputs['release_hour'] = '00';
		}
		$release_date = strtotime("{$inputs['release_year']}-{$inputs['release_month']}-{$inputs['release_day']} {$inputs['release_hour']}:{$inputs['release_min']}");
		$inputs['release_date'] = date("Y/m/d H:i",$release_date);
		
		// バリデーション
		$validator = Validator::make($inputs,array(
			'title'			=> "required|max:50",
			'note'			=> "required",
			'genre_id'		=> "required",
			'cp'			=> "required|max:50",
			'description'	=> "required|max:255",
			'postscript'	=> "required|max:255",
			'release_date'		=> "required|date",
		));
		$validator->sometimes('new_group_text', 'required|max:15|unique:groups,name', function($inputs)
			{return isset($inputs['new_group']);});
		$validator->sometimes('new_group_memo', 'max:255', function($inputs)
			{return isset($inputs['new_group']);});
		$valid_name = array(
			'title'			=> "タイトル",
			'note'			=> "本文",
			'genre_id'		=> "ジャンル",
			'description'	=> "コメント",
			'cp'			=> "カップリング",
			'postscript'	=> "説明",
			'new_group_text'=> "シリーズ名",
			'release_date'	=> "投稿日",
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
				'title'		=> $inputs['title'],
				'genre_id'		=> $inputs['genre_id'],
				'description'	=> $inputs['description'],
				'postscript'	=> $inputs['postscript'],
				'cp'			=> $inputs['cp'],
				'group_id'		=> !empty($inputs['group_id'])?$inputs['group_id']:NULL,
				'r_flg'			=> isset($inputs['r_flg'])?Novel::ACTIVE_FLG_YES:Novel::ACTIVE_FLG_NO,
				'active_flg'	=> $inputs['active_flg'],
				'release_date'	=> $release_date
			);
			
			$group_insert = '';
			if(isset($inputs['new_group']) && !empty($inputs['new_group_text'])){
				$group_insert = array(
					'name'			=> $inputs['new_group_text'],
					'memo'			=> $inputs['new_group_memo'],
					'active_flg'	=> Group::ACTIVE_FLG_YES
				);
			}
			
			// DB処理
			// 新規シリーズの登録があった場合
			if(!empty($group_insert)){
				try{
					DB::beginTransaction();
					$group = new Group();
					foreach($group_insert as $group_key => $group_value){
						$group->{$group_key} = $group_value;
					}
					$group->save();
					$insert_data['group_id'] = $group->id;
					DB::commit();
				}catch(Exception $e){
					DB::rollback();
					Session::flash('message', '更新に失敗しました');
					return Redirect::to('/admin/txt')->withInput();
				}
			}
			

			try{
				DB::beginTransaction();
				if(!is_null($id)){
					$novel = Novel::find($id);
				}else{
					$novel = new Novel();
				}
				// データセット
				foreach($insert_data as $insert_key => $insert_value){
					$novel->{$insert_key} = $insert_value;
				}
				$novel->save();
				if(is_null($id)){
					$id = $novel->id;
				}
				// テキストファイル作成
				File::put(Config::get('my_config.file_path.novel')."{$id}.txt", $inputs['note']);
				DB::commit();
				Session::flash('message', '小説を更新しました');
				return Redirect::to('/admin/txt')->withInput();
			}catch(Exception $e){
				var_dump($e->getMessage());
				exit();
				DB::rollback();
				Session::flash('message', '更新に失敗しました');
				return Redirect::to('/admin/txt')->withInput();
			}
		}
		
		if(!is_null($id)){
			return Redirect::to("/admin/txt/edit/{$id}")->withInput();
		}
		return Redirect::to('/admin/txt/edit')->withInput();
		
	}
	
}