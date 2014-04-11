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
		if(File::exists(Config::get('my_config.file_path.main_img'))){
			$this->layout->main_img = '/img/common/main_img.jpg';
		}else{
			$this->layout->main_img = 'http://cambelt.co/800x200';
		}
		$this->layout->pagename	= 'INDEX';
		
		// 更新履歴の取得
		
		// BLOGから最新の1件を取得
		$blog_query = DB::table('blogs')
				->select('id','body','release_date')
				->where('active_flg',Blog::ACTIVE_FLG_YES)
				->where('draft_flg',Blog::DRAFT_FLG_NO)
				->orderBy('release_date','DESC')
				->limit(1);
		
		// LINK一覧を取得
		$link_query = DB::table('links')
				->select(
						'links.id as link_id',
						'links.name as sitename',
						'links.url',
						'links.genre_id',
						'genres.name as genre_name'
						)
				->leftJoin('genres', 'genres.id', '=', 'links.genre_id')
				->orderBy('genres.order','ASC');
		
		// 更新履歴を取得
		if(File::exists(Config::get('my_config.file_path.lastupdate'))){
			// 存在していたらファイルの読み込み
			$files		= File::get(Config::get('my_config.file_path.lastupdate'));
			$lastupdatearr	= explode("\r", $files);
			if(!empty($files)){
				// 最終更新日
				$lastupdate	= date('Y/m/d(D)',  strtotime(explode(':',explode("\n", $files)[0])[0]));
			}
		}
		
		try{
			$blog_data = $blog_query->first();
			$link_data = $link_query->get();
		}catch(Exception $e){
			$blog_data = '';
			$link_data = '';
			echo $e->getMessage();
		}
		
		// データ整形
		$headline = '';
		if(!empty($blog_data)){
			$headline = array(
				'id' => $blog_data->id,
				'date' => date('Y/m/d (D)',$blog_data->release_date),
				'body' => $blog_data->body.(mb_strlen($blog_data->body)>200?'…':''),
			);
		}
		$link_list = '';
		if(!empty($link_data)){
			foreach($link_data as $link_value){
				$link_list[$link_value->genre_id]['genre_name'] = $link_value->genre_name;
				$link_list[$link_value->genre_id]['link_detail'][$link_value->link_id] = array(
						'name' => $link_value->sitename,
						'url' => $link_value->url
				);
			}
		}
		
		// データのセット
		$data = array(
			'headline'		=> $headline,
			'lastupdatearr'	=> @$lastupdatearr,
			'lastupdate'	=> @$lastupdate,
			'link_list'	=> $link_list,
		);
		
		$this->layout->nest('content','user.index',$data);
	}

}