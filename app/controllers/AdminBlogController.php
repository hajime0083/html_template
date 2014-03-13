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
		
	}
}