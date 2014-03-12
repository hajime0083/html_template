<?php
class Pictxt extends Eloquent {
	// 表示非表示
	const ACTIVE_FLG_YES	= 1;
	const ACTIVE_FLG_NO		= 0;
	
	// タイプ
	const TYPE_IMG = 1;	// 画像
	const TYPE_TXT = 2;	// テキスト
	
	// レーティング
	const R18_YES	= 1;
	const R18_NO	= 0;
}