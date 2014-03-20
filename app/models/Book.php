<?php
class Book extends Eloquent {
	// 表示非表示
	const ACTIVE_FLG_YES	= 1;
	const ACTIVE_FLG_NO		= 0;
	
	// タイプ
	const TYPE_COM = 1;	// 画像
	const TYPE_NOV = 2;	// テキスト
	
	// レーティング
	const R18_YES	= 1;
	const R18_NO	= 0;
	
	// 新刊・既刊
	const NEW_FLG_YES	= 1;
	const NEW_FLG_NO	= 0;
	
	// 売り切れ
	const SOLD_FLG_NOTMENY	= 2;	// 残部数少
	const SOLD_FLG_YES		= 1;	// 売り切れ
	const SOLD_FLG_NO		= 0;	// 在庫有り
	
    protected function getDateFormat()
    {
        return 'U';
    }
	
}