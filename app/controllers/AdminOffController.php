<?php

class AdminOffController extends AdminBaseController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex(){
		// 既刊一覧を取得
		$query_books = DB::table('books')
					->select(
							'books.id',
							'books.title',
							'books.issued_at',
							'books.active_flg',
							'genres.name'
							)
					->leftJoin('genres', 'genres.id', '=', 'books.genre_id')
					->orderBy('issued_at','DESC');
		try{
			$book_data = $query_books->get();
		}catch(Exception $e){
			$book_data = '';
		}
		
		$book_list = '';
		// データの成型
		if(!empty($book_data)){
			foreach($book_data as $book_value){
				$book_list[] = array(
					'id'			=> $book_value->id,
					'title'			=> $book_value->title,
					'issued_at'		=> (!is_null($book_value->issued_at)?date('Y年m月d日',$book_value->issued_at):'未定'),
					'active_flg'	=> $book_value->active_flg,
					'genre'			=> $book_value->name,
				);
			}
		}
		
		// イベント予定の取得
		if(File::exists(Config::get('my_config.file_path.event'))){
			// 存在していたらファイルの読み込み
			$event		= File::get(Config::get('my_config.file_path.event'));
		}else{
			// 存在しなかった場合ファイルの生成
			File::append(Config::get('my_config.file_path.event'),'');
			$event = '';
		}

		// データのセット
		$data = array(
			'book_list' => $book_list,
			'event' => $event,
		);
		
		return $this->layout->nest('content','admin.offline.index',$data);
		
	}
	
	
	public function getEdit($id = NULL){
		
		$this->layout->js		.= HTML::script('js/imgLiquid-min.js');
		$this->layout->js		.= HTML::script('js/admin_off.js');
		
		// 初期化
		$issued_year	= '';
		$issued_month	= '';
		$issued_day		= '';
		$active_flg		= Book::ACTIVE_FLG_YES;
		$h2				= '新規';

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
		$type_list = Config::get('my_config.book_type');
		
		// 修正の場合データの取得
		if(!is_null($id)){
			$h2 = '編集';
			$query_book = DB::table('books')
						->select()
						->where('books.id', $id);
			try{
				$book_data = $query_book->first();
			}catch(Exception $e){
				$book_data = '';
			}
			
			if(empty($book_data)){
				// エラー処理
				Redirect::to('/admin/offline/');
			}
			
			// データ整形			
			// 発行日
			if(!is_null($book_data->issued_at)){
				$issued_year = date('Y',$book_data->issued_at);
				$issued_month = date('m',$book_data->issued_at);
				$issued_day = date('d',$book_data->issued_at);
			}
			
		}
		
		$data = array(
			'title'			=> @$book_data->title,
			'genre_id'		=> @$book_data->genre_id,
			'discription'	=> @$book_data->discription,
			'new_flg'		=> @$book_data->new_flg,
			'size'			=> @$book_data->size,
			'page'			=> @$book_data->page,
			'type'			=> @$book_data->type,
			'cp'			=> @$book_data->cp,
			'price'			=> @$book_data->price,
			'r_flg'			=> @$book_data->r_flg,
			'cover_image'	=> @$book_data->cover_image,
			'sample_1'		=> @$book_data->sample_1,
			'sample_2'		=> @$book_data->sample_2,
			'sample_3'		=> @$book_data->sample_3,
			'issued_year'	=> @$issued_year,
			'issued_month'	=> @$issued_month,
			'issued_day'	=> @$issued_day,
			'sold_flg'		=> @$book_data->sold_flg,
			'active_flg'	=> @$active_flg,
			'h2'			=> $h2,
			'genre_list'	=> $genre_list,
			'type_list'	=> $type_list,
		);
		return $this->layout->nest('content','admin.offline.edit',$data);
	}
	
	public function postIndex(){
		$inputs		= Input::all();
		File::put(Config::get('my_config.file_path.event'), trim($inputs['event']));
		return Redirect::to('/admin/offline/');
	}
	
	public function postEdit($id = NULL){
		// データ取得
		$inputs = Input::all();
		
		// 発行日
		$inputs['issued_date'] = "{$inputs['issued_year']}{$inputs['issued_month']}{$inputs['issued_day']}";

		// バリデーション
		$validator = Validator::make($inputs,array(
			'title'				=> "required|max:50",
			'discription'		=> "required|max:1000",
			'genre_id'			=> "required",
		));
		$validator->sometimes('page', 'integer|min:4', function($inputs)
			{return !empty($inputs['page']);});
		$validator->sometimes('issued_date', 'date', function($inputs)
			{return !empty($inputs['issued_date']);});
		$validator->sometimes('price', 'integer', function($inputs)
			{return !empty($inputs['price']);});
		// バリデーション用メッセージ
		$valid_name = array(
			'title'				=> "タイトル",
			'discription'		=> "説明文",
			'genre_id'			=> "ジャンル",
			'page'				=> "ページ数",
			'price'				=> "価格",
			'issued_date'		=> "発行日",
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

			// データ成型discription
			$insert_data = array(
				'title'			=> $inputs['title'],
				'genre_id'		=> $inputs['genre_id'],
				'discription'	=> $inputs['discription'],
				'new_flg'		=> (isset($inputs['new_flg'])?Book::NEW_FLG_YES:Book::SOLD_FLG_NO),
				'size'			=> $inputs['size'],
				'type'			=> $inputs['type'],
				'cp'			=> $inputs['cp'],
				'page'			=> (empty($inputs['page'])?NULL:$inputs['page']),
				'price'			=> (empty($inputs['price'])?NULL:$inputs['price']),
				'r_flg'			=> (!isset($inputs['r_flg'])?Book::R18_NO:Book::R18_YES),
				'issued_at'		=> (empty($inputs['issued_date'])?NULL:  strtotime($inputs['issued_date'])),
				'sold_flg'		=> $inputs['sold_flg'],
				'active_flg'	=> $inputs['active_flg'],
			);
			
			// DB処理
			if(!is_null($id)){
				$book = Book::find($id);
			}else{
				$book = new Book();
			}
			// データセット
			foreach($insert_data as $insert_key => $insert_value){
				$book->{$insert_key} = $insert_value;
			}
		
			// 画像
			$filename			= ceil(microtime(true)*1000);
			$destinationPath	= Config::get('my_config.img_path.book');
			$cover_image		= @$inputs['cover_image'];
			$sample_1			= @$inputs['sample_1'];
			$sample_2			= @$inputs['sample_2'];
			$sample_3			= @$inputs['sample_3'];

			try{
				DB::beginTransaction();
				
				// 画像アップロード
				if(!empty($cover_image) && !isset($inputs['del_cover_image'])){
					$ext			= $cover_image->getClientOriginalExtension();
					$cover_image->move($destinationPath, $filename.'_cover.'.$ext);
					$book->cover_image = $filename.'_cover.'.$ext;
				}elseif(isset($inputs['del_cover_image']) && !empty($inputs['old_cover_image'])){
					// 既存画像削除
					$book->cover_image = NULL;
					File::delete($destinationPath.$inputs['old_cover_image']);
				}
				if(!empty($sample_1) && !isset($inputs['del_sample_1'])){
					$ext			= $sample_1->getClientOriginalExtension(); 
					$upload_success	= $sample_1->move($destinationPath, $filename.'_sample_1.'.$ext);
					$book->sample_1 = $filename.'_sample_1.'.$ext;
				}elseif(isset($inputs['del_sample_1']) && !empty($inputs['old_sample_1'])){
					// 既存画像削除
					$book->sample_1 = NULL;
					File::delete($destinationPath.$inputs['old_sample_1']);
				}
				if(!empty($sample_2) && !isset($inputs['del_sample_2'])){
					$ext			= $sample_2->getClientOriginalExtension(); 
					$upload_success	= $sample_2->move($destinationPath, $filename.'_sample_2.'.$ext);
					$book->sample_2 = $filename.'_sample_2.'.$ext;
				}elseif(isset($inputs['del_sample_2']) && !empty($inputs['old_sample_2'])){
					// 既存画像削除
					$book->sample_2 = NULL;
					File::delete($destinationPath.$inputs['old_sample_2']);
				}
				if(!empty($sample_3) && !isset($inputs['del_sample_3'])){
					$ext			= $sample_3->getClientOriginalExtension(); 
					$upload_success	= $sample_3->move($destinationPath, $filename.'_sample_3.'.$ext);
					$book->sample_3 = $filename.'_sample_3.'.$ext;
				}elseif(isset($inputs['del_sample_3']) && !empty($inputs['old_sample_3'])){
					// 既存画像削除
					$book->sample_3 = NULL;
					File::delete($destinationPath.$inputs['old_sample_3']);
				}
				// DB保存
				$book->save();
				DB::commit();
				Session::flash('message', '更新完了しました');
				return Redirect::to('/admin/offline/');
			}catch(Exception $e){
				DB::rollback();
				Session::flash('message', '更新に失敗しました');
			}
		}
		
		if(!is_null($id)){
			return Redirect::to("/admin/offline/edit/{$id}")->withInput();
		}
		
		return Redirect::to('/admin/offline/edit')->withInput();

	}
	
}