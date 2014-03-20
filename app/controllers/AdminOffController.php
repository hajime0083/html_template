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
					->orderBy('issued_at');
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
					'issued_at'		=> date('Y年m月d日',$book_value->issued_at),
					'active_flg'	=> $book_value->active_flg,
					'genre'			=> $book_value->name,
				);
			}
		}

		// データのセット
		$data = array(
			'book_list' => $book_list,
		);
		
		return $this->layout->nest('content','admin.offline.index',$data);
		
	}
	
	
	public function getEdit($id = NULL){
		
	}
	
	public function postEdit($id = NULL){
		
	}
	
}