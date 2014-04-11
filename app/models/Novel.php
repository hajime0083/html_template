<?php
class Novel extends Eloquent {
	
	// 表示非表示
	const ACTIVE_FLG_YES	= 1;
	const ACTIVE_FLG_NO		= 0;
	
	// レーティング
	const R18_YES	= 1;
	const R18_NO	= 0;
	
    protected function getDateFormat()
    {
        return 'U';
    }
}