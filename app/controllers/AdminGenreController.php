<?php

class AdminGenreController extends AdminBaseController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex(){
		// ジャンルの一覧を取得
		$query_genre = DB::table('genres')
					->select()
					->orderBy('order');
		try{
			$genre_list = $query_genre->get();
		}catch(Exception $e){
			$genre_list = '';
		}

		// データのセット
		$data = array(
			'genre_list' => $genre_list,
		);
		
		$this->layout->nest('content','admin.genre.index',$data);
		
	}
	
	public function postIndex(){
		
		$inputs = Input::all();

		
		if($inputs['type'] == 'add'){
			// 新規登録
			// バリデーション
			$validator = Validator::make($inputs,array(
				'name' => 'required|max:15|unique:genres,name',
				'order' => 'required|integer|min:0|max:100',
			));
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
				$insert_data = array(
					'name' => $inputs['name'],
					'order' => $inputs['order'],
					'active_flg' => (isset($inputs['active_flg'])?Genre::ACTIVE_FLG_YES:Genre::ACTIVE_FLG_NO)
				);
				try{
					DB::beginTransaction();
					$genre = new Genre;
					foreach($insert_data as $insert_key => $insert_value){
						$genre->{$insert_key} = $insert_value;
					}
					$genre->save();
					DB::commit();

					// 登録完了のメッセージ
					Session::flash('message', '更新完了');
				}catch(Exception $e){
					DB::rollback();
					Session::flash('message', '更新出来ませんでした');
				}
			}
			return Redirect::back();
			
		}else{
			
			// 更新
			// バリデーション
			$rules = '';
			foreach(array_keys($inputs['name']) as $name_key){
				$rules["name.$name_key"] = "required|max:15|unique:genres,name,{$name_key}";
				$rules["order.$name_key"] = "required|integer|min:0|max:100";
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
					$active_flg = (isset($inputs['active_flg'][$name_key])?Genre::ACTIVE_FLG_YES:Genre::ACTIVE_FLG_NO);
					$insert_data[$name_key] = array(
						'name' => $name_value,
						'active_flg' => $active_flg,
						'order' => $inputs['order'][$name_key]
					);
				}

				if(is_array($insert_data)){
					try{
						DB::beginTransaction();
						foreach($insert_data as $insert_key => $insert_value){
							$genre = Genre::find($insert_key);
							foreach($insert_value as $insert_value_key => $insert_value_value){
								$genre->{$insert_value_key} = $insert_value_value;
							}
							$genre->save();
						}
						DB::commit();

						// 登録完了のメッセージ
						Session::flash('message', '更新完了');

					}catch(Exception $e){
						DB::rollback();
						Session::flash('message', '更新出来ませんでした');
					}
				}
				
				return Redirect::route('genre');
				
			}
		}

		
		
	}
}