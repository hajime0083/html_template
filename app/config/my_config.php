<?php

return array(
	'img_path' => array(
		'book' => public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR,
		'blog' => public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'blog'.DIRECTORY_SEPARATOR,
		'common' => public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR,
	),
	'file_path' => array(
		'lastupdate' => public_path().DIRECTORY_SEPARATOR.'contfile'.DIRECTORY_SEPARATOR.'lastupdate.txt',
		'event' => public_path().DIRECTORY_SEPARATOR.'contfile'.DIRECTORY_SEPARATOR.'event.txt',
		'main_img' => public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'main_img.jpg',
		'novel' => public_path().DIRECTORY_SEPARATOR.'main'.DIRECTORY_SEPARATOR.'txt'.DIRECTORY_SEPARATOR,
		'pic' => public_path().DIRECTORY_SEPARATOR.'main'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR,
	),
	
	'sitename'	=> 'SUISOU',
	'page_size' => array(
		''	=> '未定',
		1	=> 'B5',
		2	=> 'A5',
		3	=> 'B6',
		4	=> '文庫',
	),
	'sold_flg' => array(
		Book::SOLD_FLG_NO	=> '有り',
		Book::SOLD_FLG_YES	=> '無し',
		Book::SOLD_FLG_NOTMENY	=> '残部少',
	),
	'book_type' => array(
		0	=> '未定',
		1	=> '漫画',
		2	=> '小説',
		3	=> '漫画＆小説',
	),
	'lastupdate_num'	=> 8,
);
