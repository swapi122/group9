<?php

if (!defined("EXPONENT")) exit("");
	global $db;
	$session_id = 1;
	
	$donhang=$db->selectColumn("donhang","madh");
	//print_r($giohang);
	$len=count($donhang);
	for ($i=0;$i<$len;$i++)
	{
		// lay id cua record hien thoi trong $giohang
		$myid=$donhang[$i];
		// lay gia tri khi REQUEST
		$myid_value=$_REQUEST["tt{$myid}"];
		// update
		$db->sql("UPDATE exponent_donhang SET tinhtrang={$myid_value} WHERE madh={$myid}");
	}
	exponent_flow_redirect();
?>
