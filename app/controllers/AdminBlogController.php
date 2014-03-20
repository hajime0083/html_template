<?php

class AdminBlogController extends AdminBaseController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex()
	{		
		
		// データの取得
		// 過去記事の一覧を取得
		$query_blog = DB::table('blogs')
					->select(
							'blogs.id',
							'blogs.title',
							'blogs.draft_flg',
							'blogs.release_date',
							'blog_genres.name'
							)
					->leftJoin('blog_genres', 'blog_genres.id', '=', 'blogs.blog_genre')
					->where('blogs.active_flg',Blog::ACTIVE_FLG_YES)
					->where('blogs.draft_flg',Blog::DRAFT_FLG_NO)
					->where('blogs.user_id',Auth::user()->id)
					->orderBy('blogs.release_date','DESC');
		// 下書き記事の一覧を取得
		$query_draftblog = DB::table('blogs')
					->select(
							'blogs.id',
							'blogs.title',
							'blogs.draft_flg',
							'blogs.created_at',
							'blog_genres.name'
							)
					->leftJoin('blog_genres', 'blog_genres.id', '=', 'blogs.blog_genre')
					->where('blogs.active_flg',Blog::ACTIVE_FLG_YES)
					->where('blogs.draft_flg',Blog::DRAFT_FLG_YES)
					->where('blogs.user_id',Auth::user()->id)
					->orderBy('blogs.created_at','DESC');
		try{
			$blog_data = $query_blog->get();
			$draftblog_data = $query_draftblog->get();
		}catch(Exception $e){
			$blog_data = '';
			$draftblog_data = '';
		}
		
		// データ成型
		$blog_list = '';
		if(!empty($blog_data)){
			foreach($blog_data as $blog_value){
				$blog_list[] = array(
					'id' => $blog_value->id,
					'title' => $blog_value->title,
					'genre' => $blog_value->name,
					'created_at' => date('Y年m月d日',$blog_value->release_date),
				);
			}
		}
		$draftblog_list = '';
		if(!empty($draftblog_data)){
			foreach($draftblog_data as $draftblog_value){
				$draftblog_list[] = array(
					'id' => $draftblog_value->id,
					'title' => $draftblog_value->title,
					'genre' => $draftblog_value->name,
					'created_at' => date('Y年m月d日',$draftblog_value->created_at),
				);
			}
		}
		
		// データのセット
		$data = array(
			'blog_list' => $blog_list,
			'draftblog_list' => $draftblog_list,
		);
		
		$this->layout->nest('content','admin.blog.index',$data);
	}
	
	/* getEdit
	 * 新規登録OR修正
	 */
	public function getEdit($id = NULL)
	{
		// 初期化
		$h2				= "更新";
		$title			= '';
		$body			= '';
		$body_detail	= '';
		$blog_genre		= NULL;
		$active_flg		= Blog::ACTIVE_FLG_YES;
		$release_year	= date('Y');
		$release_month	= date('m');
		$release_day	= date('d');
		$release_hour	= date('H');
		$release_min	= date('i');
		$reserve_flg	= FALSE;

		if(is_null($id)){
			// 新規登録
			$h2				= "新規";
			$reserve_flg	= TRUE;
		}else{
			// 修正
			$query_blog = DB::table('blogs')
						->select()
						->where('blogs.id', $id)
						->where('blogs.user_id', Auth::user()->id);
			try{
				$blog_data = $query_blog->first();
			}catch(Exception $e){
				$blog_data = '';
			}
			
			if(empty($blog_data)){
				// エラー処理
				Redirect::to('/admin/blog/');
			}
			
			// 表示値のセット
			$title			= $blog_data->title;
			$body			= $blog_data->body;
			$body_detail	= $blog_data->body_detail;
			$blog_genre		= $blog_data->blog_genre;
			$active_flg		= $blog_data->active_flg;
			$release_year	= date('Y',$blog_data->release_date);
			$release_month	= date('m',$blog_data->release_date);
			$release_day	= date('d',$blog_data->release_date);
			$release_hour	= date('H',$blog_data->release_date);
			$release_min	= date('i',$blog_data->release_date);
			
		}
		
		// プルダウン生成
		$query_bloggenre = DB::table('blog_genres')
					->select('id','name')
					->where('blog_genres.active_flg', BlogGenre::ACTIVE_FLG_YES)
					->orderBy('blog_genres.order');
		try{
			$bloggenre_list = $query_bloggenre->get();
		}catch(Exception $e){
			$bloggenre_list = '';
		}
		$genre_list[NULL] = '--カテゴリを選択して下さい--';
		if(!empty($bloggenre_list)){
			foreach($bloggenre_list as $bloggenre_value){
				$genre_list[$bloggenre_value->id] = $bloggenre_value->name;
			}
		}

		// データのセット
		$data = array(
			'h2'			=> $h2,
			'title'			=> $title,
			'body'			=> $body,
			'body_detail'	=> $body_detail,
			'blog_genre'	=> $blog_genre,
			'genre_list'	=> $genre_list,
			'active_flg'	=> $active_flg,
			'release_year'	=> $release_year,
			'release_month' => $release_month,
			'release_day'	=> $release_day,
			'release_hour'	=> $release_hour,
			'release_min'	=> $release_min,
			'reserve_flg'	=> $reserve_flg,
		);
		$this->layout->nest('content','admin.blog.edit',$data);
	}
	
	/* postEdit
	 * 登録処理
	 */
	public function postEdit($id = NULL)
	{
		// データ取得
		$inputs = Input::all();
		
		// 公開日
		$release_date = date('U');
		if(!isset($inputs['reserve_flg'])){
			// 日付け指定公開
			$release_date = strtotime("{$inputs['release_year']}-{$inputs['release_month']}-{$inputs['release_day']} {$inputs['release_hour']}:{$inputs['release_min']}");
		}
		$inputs['release_date'] = date("Y/m/d H:i",$release_date);

		// バリデーション
		$validator = Validator::make($inputs,array(
			'title'				=> "required|max:50",
			'body'				=> "required|max:1000",
			'body_detail'		=> "required|max:1000",
			'release_date'		=> "required|date",
		));
		$valid_name = array(
			'title'				=> "タイトル",
			'body'				=> "本文",
			'body_detail'		=> "本文2",
			'new_genre_text'	=> "新しいカテゴリ",
			'blog_genre'		=> "カテゴリ",
			'release_date'		=> "投稿日",
		);
		$validator->sometimes('new_genre_text', 'required|max:15|unique:blog_genres,name', function($inputs)
			{return isset($inputs['new_genre']);});
		$validator->sometimes('blog_genre', 'required', function($inputs)
			{return !isset($inputs['new_genre']);});
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

			// データ成型
			$insert_data = array(
				'title'			=> $inputs['title'],
				'body'			=> $inputs['body'],
				'body_detail'	=> $inputs['body_detail'],
				'blog_genre'	=> $inputs['blog_genre'],
				'active_flg'	=> $inputs['active_flg'],
				'draft_flg'		=> (isset($inputs['draft_flg'])?Blog::DRAFT_FLG_YES:Blog::DRAFT_FLG_NO),
				'release_date'	=> $release_date,
				'user_id'		=> Auth::user()->id,
			);
			$genre_insert = '';
			if(isset($inputs['new_genre']) && !empty($inputs['new_genre_text'])){
				$genre_insert = array(
					'name'			=> $inputs['new_genre_text'],
					'active_flg'	=> Genre::ACTIVE_FLG_YES,
					'order'			=> 0
				);
			}
			
			// DB処理
			// 新規カテゴリの登録があった場合
			if(!empty($genre_insert)){
				try{
					DB::beginTransaction();
					$genre = new BlogGenre();
					foreach($genre_insert as $genre_key => $genre_value){
						$genre->{$genre_key} = $genre_value;
					}
					$genre->save();
					$insert_data['blog_genre'] = $genre->id;
					DB::commit();
				}catch(Exception $e){
					DB::rollback();
					Session::flash('message', '更新に失敗しました');
					return Redirect::to('/admin/blog')->withInput();
				}
			}
			
			if(!is_null($id)){
				$blog = Blog::find($id);
			}else{
				$blog = new Blog();
			}
			// データセット
			foreach($insert_data as $insert_key => $insert_value){
				$blog->{$insert_key} = $insert_value;
			}
			
			try{
				DB::beginTransaction();
				$blog->save();
				DB::commit();
				Session::flash('message', '更新完了しました');
			}catch(Exception $e){
				DB::rollback();
				Session::flash('message', '更新に失敗しました');
			}
		}
		
		if(!is_null($id)){
			return Redirect::to("/admin/blog/edit/{$id}")->withInput();
		}
		return Redirect::to('/admin/blog/edit')->withInput();
		
	}
	
	public function getCategory(){
		// ジャンルの一覧を取得
		$query_genre = DB::table('blog_genres')
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
		
		$this->layout->nest('content','admin.blog.cate',$data);
		
	}
	
	public function postCategory(){
		$inputs = Input::all();

		// バリデーション
		$rules = '';
		foreach(array_keys($inputs['name']) as $name_key){
			$rules["name.$name_key"] = "required|max:15|unique:blog_genres,name,{$name_key}";
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
				$active_flg = (isset($inputs['active_flg'][$name_key])?BlogGenre::ACTIVE_FLG_YES:BlogGenre::ACTIVE_FLG_NO);
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
						$blog_genre = BlogGenre::find($insert_key);
						foreach($insert_value as $insert_value_key => $insert_value_value){
							$blog_genre->{$insert_value_key} = $insert_value_value;
						}
						$blog_genre->save();
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

		return Redirect::to('/admin/blog/category')->withInput();
	}
}