<?php

class UserOfflineController extends UserBaseController {

	/* getIndex
	 * インデックス
	 */
	public function getIndex()
	{
		$this->layout->js		.= HTML::script('js/colorbox.js');
		$this->layout->css		.= HTML::style('css/offline.css');
		$this->layout->pagename	= 'OFFLLINE';
		
		// ベースURLの作成
		$query_base = DB::table('books')
					->select(
							'books.title',
							'books.discription',
							'books.cover_image',
							'books.sample_1',
							'books.sample_2',
							'books.sample_3',
							'books.size',
							'books.page',
							'books.price',
							'books.type',
							'books.cp',
							'books.r_flg',
							'books.issued_at',
							'books.sold_flg',
							'genres.name'
							)
					->leftJoin('genres', 'genres.id', '=', 'books.genre_id')
					->where('books.active_flg', Book::ACTIVE_FLG_YES)
					->orderBy('genres.order','ASC')
					->orderBy('issued_at','DESC');
		
		// 新刊一覧の取得
		$query_new = clone $query_base;
		$query_new->where('books.new_flg', Book::NEW_FLG_YES)
				->where('books.sold_flg','<>', Book::SOLD_FLG_YES);

		// 既刊一覧の取得
		$query_book = clone $query_base;
		$query_book->where('books.new_flg', Book::NEW_FLG_NO)
				->where('books.sold_flg','<>', Book::SOLD_FLG_YES);
		
		// 完売一覧の取得
		$query_sold = clone $query_base;
		$query_sold->where('books.sold_flg', Book::SOLD_FLG_YES);
		
		// SQL実行
		try{
			$newbook_data	= $query_new->get();
			$book_data		= $query_book->get();
			$soldbook_data	= $query_sold->get();
		}catch(Exception $e){
			$newbook_data	= '';
			$book_data		= '';
			$soldbook_data	= '';
		}
		
		$newbook_list = '';
		// データの成型
		if(!empty($newbook_data)){
			foreach($newbook_data as $newbook_value){
				$newbook_list[] = array(
					'title'			=> $newbook_value->title,
					'discription'	=> $newbook_value->discription,
					'cover_image'	=> $newbook_value->cover_image,
					'sample_1'		=> $newbook_value->sample_1,
					'sample_2'		=> $newbook_value->sample_2,
					'sample_3'		=> $newbook_value->sample_3,
					'size'			=> Config::get("my_config.page_size.{$newbook_value->size}"),
					'page'			=> (!is_null($newbook_value->page)?$newbook_value->page.'P':'ページ数未定'),
					'price'			=> (!is_null($newbook_value->price)?($newbook_value->price == 0?'無料配布':$newbook_value->price.'円'):'価格未定'),
					'issued_at'		=> (!is_null($newbook_value->issued_at)?date('Y年m月d日発行予定',$newbook_value->issued_at):'発行日未定'),
					'genre'			=> $newbook_value->name,
					'type'			=> Config::get("my_config.book_type.{$newbook_value->type}"),
					'cp'			=> $newbook_value->cp,
					'r_flg'			=> $newbook_value->r_flg,
					'sold_flg'		=> $newbook_value->sold_flg,
				);
			}
		}
		$book_list = '';
		if(!empty($book_data)){
			foreach($book_data as $book_value){
				$book_list[] = array(
					'title'			=> $book_value->title,
					'discription'	=> $book_value->discription,
					'cover_image'	=> $book_value->cover_image,
					'sample_1'		=> $book_value->sample_1,
					'sample_2'		=> $book_value->sample_2,
					'sample_3'		=> $book_value->sample_3,
					'size'			=> Config::get("my_config.page_size.{$book_value->size}"),
					'page'			=> (!is_null($book_value->page)?$book_value->page.'P':'ページ数未定'),
					'price'			=> (!is_null($book_value->price)?($book_value->price == 0?'無料配布':$book_value->price.'円'):'価格未定'),
					'issued_at'		=> (!is_null($book_value->issued_at)?date('Y年m月d日発行',$book_value->issued_at):'発行日未定'),
					'genre'			=> $book_value->name,
					'type'			=> Config::get("my_config.book_type.{$book_value->type}"),
					'cp'			=> $book_value->cp,
					'r_flg'			=> $book_value->r_flg,
					'sold_flg'		=> $book_value->sold_flg,
				);
			}
		}
		$sold_list = '';
		if(!empty($soldbook_data)){
			foreach($soldbook_data as $soldbook_value){
				$sold_list[] = array(
					'title'			=> $soldbook_value->title,
					'size'			=> Config::get("my_config.page_size.{$soldbook_value->size}"),
					'page'			=> (!is_null($soldbook_value->page)?$soldbook_value->page.'P':'ページ数未定'),
					'price'			=> (!is_null($soldbook_value->price)?($soldbook_value->price == 0?'無料配布':$soldbook_value->price.'円'):'価格未定'),
					'issued_at'		=> (!is_null($soldbook_value->issued_at)?date('Y年m月d日発行',$soldbook_value->issued_at):'発行日未定'),
					'genre'			=> $soldbook_value->name,
					'cp'			=> $soldbook_value->cp,
					'type'			=> Config::get("my_config.book_type.{$soldbook_value->type}"),
					'r_flg'			=> $soldbook_value->r_flg,
				);
			}
		}
		
		// イベント情報の取得
		if(File::exists(Config::get('my_config.file_path.event'))){
			// 存在していたらファイルの読み込み
			$files		= File::get(Config::get('my_config.file_path.event'));
			$event	= explode("\r", $files);
		}
		
		// データのセット
		$data = array(
			'newbook_list' => $newbook_list,
			'book_list' => $book_list,
			'sold_list' => $sold_list,
			'event'		=> @$event,
		);
		$this->layout->nest('content','user.offline',$data);
	}

}