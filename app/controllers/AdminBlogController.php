<?php

class AdminBlogController extends BaseAdminController {

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
							'blogs.created_at',
							'blog_genres.name'
							)
					->leftJoin('blog_genres', 'blog_genres.id', '=', 'blogs.blog_genre')
					->where('blogs.active_flg',Blog::ACTIVE_FLG_YES)
					->where('blogs.draft_flg',Blog::DRAFT_FLG_NO)
					->where('blogs.user_id',Auth::user()->id)
					->orderBy('blogs.created_at');
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
					->orderBy('blogs.created_at');
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
					'created_at' => date('Y年m月d日',$blog_value->created_at),
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
		
		$this->layout->nest('content','admin.blog_index',$data);
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
		$active_flg		= Blog::ACTIVE_FLG_NO;
		$release_year	= date('Y');
		$release_month	= date('m');
		$release_day	= date('d');
		$release_hour	= date('h');
		$release_min	= date('i');
		
		if(is_null($id)){
			// 新規登録
			$h2 = "新規";
		}else{
			// 修正
			$query_blog = DB::table('blogs')
						->select()
						->where('blogs.id', $id);
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
			$release_hour	= date('h',$blog_data->release_date);
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
		);
		$this->layout->nest('content','admin.blog_edit',$data);
	}
	
	/* postEdit
	 * 登録処理
	 */
	public function postEdit($id = NULL)
	{
		// データ取得
		$inputs = Input::all();
		// バリデーション
//		$val_rules = array(
//			'title' => array('required','max:10'),
//			'body' => array('required','max:10'),
//			'body_detail' => array('required','max:10'),
//			'category' => array('required','max:10'),
//			'category' => array('required','max:10'),
//		);
//		$val = Validator::make($inputs, $val_rules);
//		if($val->fails()){
//			// エラーがあったら処理を中断
//			return Redirect::back()->withErrors($val)->withInput();
//		}
		
		// 公開日
		$release_date = date('U');
		if(!isset($inputs['reserve_flg'])){
			// 日付け指定公開
			$release_date = strtotime("{$inputs['release_year']}-{$inputs['release_month']}-{$inputs['release_day']} {$inputs['release_hour']}:{$inputs['release_min']}");
		}
		
		// データ成型
		$insert_data = array(
			'title' => $inputs['title'],
			'body' => $inputs['body'],
			'body_detail' => $inputs['body_detail'],
			'blog_genre' => $inputs['blog_genre'],
			'active_flg' => $inputs['active_flg'],
			'draft_flg' => (isset($inputs['draft_flg'])?Blog::DRAFT_FLG_YES:Blog::DRAFT_FLG_NO),
			'release_date' => (isset($inputs['reserve_flg'])?date('U'):$release_date),
			'updated_at' => date('U'),
		);

		if(is_null($id)){
			// 新規登録
			
		}else{
			try{
				// 更新
				DB::beginTransaction();
				DB::table('blogs')
				->where('id', $id)
				->update($insert_data);
				DB::commit();
				
				// 登録完了のリダイレクト
				Session::flash('message', '更新完了');
			}catch(Exception $e){
				DB::rollback();
			}
		}
		
		return Redirect::back();
		
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
		
		$this->layout->nest('content','admin.blog_cate',$data);
		
	}
	
	public function postCategory(){
		$inputs = Input::all();
		
		// バリデーション
		$val_rules = array(
			'name' => array('required','max:10'),
			'order' => array('required','max:10'),
		);
		
		$val = Validator::make($inputs, $val_rules);
		if($val->fails()){
			// エラーがあったら処理を中断
			return Redirect::back()->withErrors($val)->withInput();
		}
		
		// 登録処理
		if($inputs['type'] == 'add'){
			// 新規登録

		}elseif($inputs['type'] == 'mod'){
			// 更新
			
		}
		
		// データセット
		$data = array(
			
		);
//		$this->layout->nest('content','admin.blog_cate',$data);
		
var_dump($inputs);
	}
}