<?php

return array(
	'product_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID,
		DB_PRIMARY=>true,
		DB_INCREMENT=>true),
	'location_data'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>250),
	'product_type_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'producer_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'tensp'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING),
	'ngaynhap'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP),
	'namsanxuat'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'xuatxu'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING),
	'baohanh'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'gia'=>array(
		DB_FIELD_TYPE=>DB_DEF_DECIMAL),
	'kickthuoc'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING),
	'mausac'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING),
	'hinhanh'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING),
	'chitiet'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>2500),
	"file_id"=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'download'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>512),
	
);

?>