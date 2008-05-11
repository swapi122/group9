<?php

if (!defined("EXPONENT")) exit("");
global $db;
$session_id=1;
if (exponent_users_isLoggedIn())
{
	$db->sql("ALTER TABLE `exponent_donhang` CHANGE `madh` `madh` BIGINT( 20 ) NOT NULL AUTO_INCREMENT");
	$mydate=time();
	// thêm đơn hàng mới
	$db->sql("INSERT INTO `exponent_donhang` (`makh` ,`ngaydathang` ,`tinhtrang` ,`giamgia`)VALUES ({$user->id}, {$mydate}, 0,0)");
	$max = $db->max("donhang", "madh" );
	$giohang=$db->selectObjects("giohang","session_id={$session_id}");
	$size=count($giohang);
	for ($i=0;$i<$size;$i++){
		{
			 $db->sql("INSERT INTO `exponent_chitietdonhang` (product_id, quality, donhang_id) VALUES ({$giohang[$i]->product_id},{$giohang[$i]->quality}, {$max})");
		}
	}
	// xóa hết các đơn hàng trong gio hàng đang có nữa ha
	
	// tạo template mới sẽ hiện ra nội dung rằng đặt hàng thành công
	//exponent_flow_redirect();
}

?>