<?php

if (!defined("EXPONENT")) exit("");
global $db;
$session_id=1;
if (exponent_users_isLoggedIn())
{
	$mydate=time();
	// thêm đơn hàng mới
	$db->sql("INSERT INTO `exponent_donhang` (`makh` ,`ngaydathang` ,`tinhtrang` ,`giamgia`)VALUES ({$user->id}, {$mydate}, 0,0)");
	$max = $db->max("donhang", "madh" );
	$giohang=$db->selectObjects("giohang","session_id={$session_id}");
	$size=count($giohang);
	// thêm và tính toán giảm giá
	$giamgia=0;
	for ($i=0;$i<$size;$i++){
		{
			 $sanpham=$db->selectObject("sanpham","id = " . $giohang[$i]->product_id);
			 if ($sanpham->khuyenmai ==1)
			 {
			 	$giamgia+=$sanpham->gia - $sanpham->gia_khuyenmai;
			 }
			 $db->sql("INSERT INTO `exponent_chitietdonhang` (product_id, quality, donhang_id) VALUES ({$giohang[$i]->product_id},{$giohang[$i]->quality}, {$max})");
			 $db->delete("giohang", "id = " . $giohang[$i]->id);
		}
	}
	// update giá khuyến mãi
	$db->sql("UPDATE exponent_donhang SET giamgia = {$giamgia} WHERE madh={$max}" );
	// tạo template mới sẽ hiện ra nội dung rằng đặt hàng thành công
	exponent_flow_redirect();
}

?>
