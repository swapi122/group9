<?php

if (!defined("EXPONENT")) exit("");
	global $db;
	$session_id = 1;
	$db->delete('giohang',"session_id = {$session_id}");
	exponent_flow_redirect();
?>
