<?php
// add new product item into basket
if (!defined("EXPONENT")) exit("");
	global $db;
	$session_id = 1;
	$time_out = 10*24*3600;
	$id=$_REQUEST['id'];
	// clear lastupdate
	$mytime=time()-$time_out;
	$db->delete("giohang","last_update < {$mytime} ");
	
	// update last_update 
	$mytime=$mytime+$time_out;
	$db->sql("UPDATE exponent_giohang SET last_update = {$mytime} WHERE session_id = {$session_id}");
	
	// check for existing
	$count=$db->countObjects("giohang"," (session_id = {$session_id}) AND (product_id = {$id})");
	if ($count > 0)
	{
		// get qualily
		$temp=$db->selectObjects("giohang"," (session_id = {$session_id}) AND (product_id = {$id})");
		// modify
		$db->sql("UPDATE exponent_giohang SET quality={$temp[0]->quality}+1 WHERE (session_id = {$session_id}) AND (product_id = {$id})");
	}
	else
	{
		// add new
		$db->sql("INSERT INTO exponent_giohang(session_id, quality, product_id) VALUES({$session_id},1,{$id})");
	}
	$sanpham=$db->selectObject("sanpham","id=".$id);
	$template = new template('giohangmodule','_additem',$loc);
	$template->assign("sanpham",$sanpham);
	$template->assign('redirect',exponent_flow_get());
	$template->output();
?>
