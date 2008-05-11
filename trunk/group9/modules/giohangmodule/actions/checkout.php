<?php

if (!defined("EXPONENT")) exit("");
	global $db;
	$session_id=1;
	exponent_users_isLoggedIn();
    $db->sql("ALTER TABLE `exponent_donhang` CHANGE `madh` `madh` BIGINT( 20 ) NOT NULL AUTO_INCREMENT");
	$mydate=time();
	$db->sql("INSERT INTO `exponent_donhang` (`makh` ,`ngaydathang` ,`tinhtrang` ,`giamgia`)VALUES ({$user->id}, {$mydate}, 0,0)");
	$max = $db->max("donhang", "id" );
	$giohang=$db->selectObject("giohang","session_id={$session_id}");
	$size=count($giohang);
	for ($i=0;$i<$size;$i++){
		$db->sql("INSERT INTO `exponent_chitietdonhang` (`product_id',`quality`) VALUE 	({$giohang->product_id},{giohang->quality})");
	}

?>
