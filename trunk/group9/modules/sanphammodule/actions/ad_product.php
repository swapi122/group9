<?php
if (!defined("EXPONENT")) exit("");
	$listing = null;
	if (isset($_GET['id'])) {
		$listing = $db->selectObject("sanpham","id=".$_GET['id']);
		if ($listing != null) {
			$loc = unserialize($listing->location_data);
		} 
	}
	
	if (exponent_permissions_check("manage",$loc)) {
		$config = $db->selectObject('sanphammodule_config',"location_data='".serialize($loc)."'");
		if ($config == null) {
			//do nothing here yes.  
		}
		$form = sanpham::form($listing);
		$form->location($loc);
		
		//$form->meta("action","save_listing");
				
		$template = new template("sanphammodule","_form_editlisting",$loc);
		$template->assign("is_edit",(isset($listing->id) ? 1 : 0));
		$template->assign("form_html",$form->toHTML());
		$template->output();
	} else {
		echo SITE_403_HTML;
		
	}












/*
if (!defined("EXPONENT")) exit("");

	$listing = null;		
	if (isset($_POST['id'])) {
		$listing = $db->selectObject('sanpham', 'id='.$_POST['id']);
		if ($listing != null) {
			$loc = unserialize($listing->location_data);
		} 
	} else {
	
	}
*/
	if (exponent_permissions_check("manage",$loc)) {	
		//Get the file save it to the temp directory
		$source = $loc->src;
		$directory = 'files/sanphammodule/'.$source;
		$file = null;
		if ($_FILES['upload']['name'] != '') {
			$file = file::update("upload",$directory,null,time()."_".$_FILES['upload']['name']);
			if ($file == null) {
				switch($_FILES["upload"]["error"]) {
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						$post['_formError'] = "The file you attempted to upload is too large.  Contact your system administrator if this is a problem.";
						break;
					case UPLOAD_ERR_PARTIAL:
						$post['_formError'] = "The file was only partially uploaded.";
						break;
					case UPLOAD_ERR_NO_FILE:
						$post['_formError'] = "No file was uploaded.";
						break;
					default:
						$post['_formError'] = "A strange internal error has occured.  Please contact the Exponent Developers.";
						break;
				}
				exponent_sessions_set("last_POST",$post);
				header("Location: " . $_SERVER['HTTP_REFERER']);
				exit("");
			}
		}
		
		//$listing = sanpham::update($_POST, $listing);
		$listing->location_data = serialize($loc);
		if ($file != null) {
			$listing->file_id = $db->insertObject($file, 'file');
		} else {
			if (!isset($listing->id)) {
				$listing->file_id = 0;
			}
		}
		
		if (isset($listing->id)) {
			$db->updateObject($listing,"listing");
		} else {
			$db->insertObject($listing,"listing");
		}		
		
		exponent_flow_redirect();
	} else {
		echo SITE_403_HTML;
	}
	

?>