<?php
class Genre extends Eloquent {
	
	// 表示非表示
	const ACTIVE_FLG_YES	= 1;
	const ACTIVE_FLG_NO		= 0;
	
	public $timestamps = FALSE;	// created_at,updated_atは使わない

}