<?php


if (!defined("EXPONENT")) exit("");
	$listing = null;
	if (isset($_GET['id'])) {
		$listing = $db->selectObject("sanpham","id=".$_GET['id']);
		if ($listing == null) {	echo SITE_404_HTML;}
	}	
		
	if ($listing->file_id!=0) {
		$file = $db->selectObject('file', "id=".$listing->file_id);
		$listing->picpath = $file->directory."/".$file->filename;
	} else {
		$listing->picpath = "";
	}
	// for product type
	$product_type=$db->selectObject("loaisanpham","id=". $listing->product_type_id);
	$provider=$db->selectObject("nhasanxuat","id=".$listing->provider_id);	
	$template = new template("sanphammodule","_viewproduct",$loc);
	$template->assign('listing', $listing);
	$template->assign('provider', $provider);
	$template->assign('ptype', $product_type);
	$template->output();
?>
