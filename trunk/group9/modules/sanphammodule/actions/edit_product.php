<?php

if (!defined("EXPONENT")) exit("");
	$listing = null;
	if (isset($_GET['id'])) {
		$listing = $db->selectObject("sanpham","id=".$_GET['id']);
	}
	
	if (exponent_permissions_check("manage",$loc)) {
		$config = $db->selectObject('sanphammodule_config',"location_data='".serialize($loc)."'");
		if ($config == null) {
			//do nothing here yes.  
		}
		$form = sanpham::form($listing);
		$form->location($loc);
		$form->meta("action","save_product");
		$form->meta("module","sanphammodule");
		if (isset($_GET['id'])) {
		$form->meta("id",$_GET['id']);
		}
				
		$template = new template("sanphammodule","_form_editlisting",$loc);
		$template->assign("is_edit",(isset($listing->id) ? 1 : 0));
		$template->assign("form_html",$form->toHTML());
		$template->output();
	} else {
		echo SITE_403_HTML;
	}

?>
