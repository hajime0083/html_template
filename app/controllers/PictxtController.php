<?php

class PictxtController extends BaseController {

	/* getPictxt
	 * 作品一覧ページ
	 */
	public function getIndex()
	{		
		// 初期化
		$pictxt_list = '';
		$this->layout->pagename	= 'PIC&TEXT';
		
		// データの取得
		$query_pictxt = DB::table('pictxts')
					->select(
							'genres.id as genre_id',
							'genres.name as genre_name',
							'pictxts.id as id',
							'pictxts.type as type',
							'pictxts.title',
							'pictxts.r_flg',
							'pictxts.filename'
							)
					->leftJoin('genres', 'pictxts.genre_id', '=', 'genres.id')
					->where('genres.active_flg',Genre::ACTIVE_FLG_YES)
					->where('pictxts.active_flg',Pictxt::ACTIVE_FLG_YES)
					->orderBy('genres.order');
		try{
			$list = $query_pictxt->get();
		}catch(Exception $e){
			$list = '';
		}
		
		if(empty($list)){
			// データが取得できなかった場合404リダイレクト
			App::abort(404);
		}

		// データの成型
		for($i=0;$i<count($list);$i++){
			$type = 'img';
			if($list[$i]->type == Pictxt::TYPE_TXT){
				$type = 'txt';
			}
			$pictxt_list[$list[$i]->genre_id]['genre_name'] = $list[$i]->genre_name;
			$pictxt_list[$list[$i]->genre_id][$type][$list[$i]->id] = array(
				'title' => $list[$i]->title,
				'r_flg' => $list[$i]->r_flg,
				'filename' => $list[$i]->filename,
			);
		}

		// データのセット
		$data = array(
			'pictxt_list' => $pictxt_list,
		);
		
		$this->layout->nest('content','user.pictxt',$data);
	}
	
	/* getTxt
	 * テキスト詳細ページ
	 */
	public function getTxt($id = NULL)
	{

		if(is_null($id)){
			// IDが空の場合404
			App::abort(404);
		}
		
		// データの取得
		$query_txt = DB::table('pictxts')
					->select(
							'users.name',
							'pictxts.type as type',
							'pictxts.title',
							'pictxts.filename',
							'pictxts.memo',
							'pictxts.created_at',
							'pictxts.updated_at'
							)
					->Join('users', 'users.id', '=', 'pictxts.user_id')
					->where('pictxts.id',$id)
					->where('pictxts.type',Pictxt::TYPE_TXT)
					->where('pictxts.active_flg',Pictxt::ACTIVE_FLG_YES);
		
		try{
			$txtdata = $query_txt->first();
		}catch(Exception $e){
			$txtdata = '';
		}
		
		if(empty($txtdata)){
			// データが取得できなかった場合404リダイレクト
			App::abort(404);
		}
		
		// 本文データの取得
		$file = File::get(public_path().DIRECTORY_SEPARATOR.'main'.DIRECTORY_SEPARATOR.'txt'.DIRECTORY_SEPARATOR.$txtdata->filename);
		if(empty($file) || $file == FALSE){
			// データが取得できなかった場合404リダイレクト
			App::abort(404);
		}
		
		$updated_at = '';
		if(!empty($txtdata->updated_at)){
			$updated_at = date('Y年n月d日',$txtdata->updated_at);
		}
		
		// データのセット
		$this->layout->pagename	= 'TEXT:'.$txtdata->title;
		$data = array(
			'title'			=> $txtdata->title,
			'txt'			=> nl2br($file),
			'memo'			=> $txtdata->memo,
			'created_at'	=> date('Y年n月d日',$txtdata->created_at),
			'updated_at'	=> $updated_at,
		);
		
		$this->layout->nest('content','user.txt',$data);
	}

}