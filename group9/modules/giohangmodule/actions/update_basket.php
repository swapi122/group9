<?php

if (!defined("EXPONENT")) exit("");
	global $db;
	$session_id = 1;
	
	$giohang=$db->selectColumn("giohang","id","session_id = {$session_id}");
	//print_r($giohang);
	$len=count($giohang);
	for ($i=0;$i<$len;$i++)
	{
		// lay id cua record hien thoi trong $giohang
		$myid=$giohang[$i];
		// lay gia tri khi REQUEST
		$myid_value=$_REQUEST["sl{$myid}"];
		// update
		$db->sql("UPDATE exponent_giohang SET quality={$myid_value} WHERE id={$myid}");
	}
	exponent_flow_redirect();
?>
