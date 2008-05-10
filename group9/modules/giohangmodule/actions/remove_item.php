<?php

if (!defined("EXPONENT")) exit("");
	global $db;
	$session_id = 1;
	
	$id=$_REQUEST['id'];
	$db->delete('giohang',"id = {$id}");
	exponent_flow_redirect();
?>
