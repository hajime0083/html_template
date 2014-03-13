<?php
class Blog extends Eloquent {
	
	// 表示非表示
	const ACTIVE_FLG_YES	= 1;
	const ACTIVE_FLG_NO		= 0;

	// 下書き処理
	const DRAFT_FLG_YES	= 1;
	const DRAFT_FLG_NO		= 0;
}